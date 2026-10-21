<?php

namespace Tests\Feature;

use App\Mail\ContactMail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;
use Laravel\Passport\Passport;
use Laravel\Passport\ClientRepository;
use Tests\TestCase;

class Php85CompatibilityTest extends TestCase
{
    public function test_api_routes_and_password_grant_are_available(): void
    {
        $routes = $this->app['router']->getRoutes();

        $this->assertSame('passport.token', $routes->match(Request::create('/oauth/token', 'POST'))->getName());
        $this->assertSame('submission.index', $routes->match(Request::create('/api/submission'))->getName());
        $this->assertTrue(Passport::$passwordGrantEnabled);
    }

    public function test_http_middleware_handles_cors_and_missing_routes(): void
    {
        $this->getJson('/php85-route-that-does-not-exist')->assertNotFound();
        $this->options('/api/submission', [], [
            'Origin' => 'https://portal.iseser.com',
            'Access-Control-Request-Method' => 'GET',
        ])->assertSuccessful()->assertHeader('Access-Control-Allow-Origin');
    }

    public function test_local_filesystem_can_store_streams(): void
    {
        Storage::fake('uploads');
        $stream = fopen('php://temp', 'w+');
        fwrite($stream, 'PHP 8.5 upload');
        rewind($stream);

        try {
            $this->assertTrue(Storage::disk('uploads')->put('compatibility.txt', $stream));
            $this->assertSame('PHP 8.5 upload', Storage::disk('uploads')->get('compatibility.txt'));
        } finally {
            fclose($stream);
        }
    }

    public function test_image_processing_uses_the_new_gd_driver(): void
    {
        $image = Image::create(2, 2)->resize(100, 100);
        $decoded = Image::read((string) $image->toPng());

        $this->assertSame(100, $decoded->width());
        $this->assertSame(100, $decoded->height());
    }

    public function test_mail_uses_the_configured_transport(): void
    {
        Mail::to('recipient@example.com')->send(new ContactMail(
            'Test Sender', 'sender@example.com', 'Compatibility', 'PHP 8.5 test'
        ));

        $this->assertCount(1, Mail::getSymfonyTransport()->messages());
    }

    public function test_password_grant_issues_a_bearer_token(): void
    {
        config(['database.default' => 'sqlite', 'database.connections.sqlite.database' => ':memory:']);
        $this->artisan('migrate', ['--force' => true])->assertSuccessful();

        $key = openssl_pkey_new(['private_key_bits' => 2048, 'private_key_type' => OPENSSL_KEYTYPE_RSA]);
        openssl_pkey_export($key, $privateKey);
        config([
            'passport.private_key' => $privateKey,
            'passport.public_key' => openssl_pkey_get_details($key)['key'],
        ]);

        User::factory()->create([
            'name' => 'Compatibility Test',
            'email' => 'php85@example.com',
            'password' => bcrypt('test-password'),
            'role' => '1',
        ]);
        $client = $this->app->make(ClientRepository::class)
            ->createPasswordGrantClient(null, 'Compatibility Test', 'http://localhost', 'users');

        $this->postJson('/oauth/token', [
            'grant_type' => 'password',
            'client_id' => $client->id,
            'client_secret' => $client->secret,
            'username' => 'php85@example.com',
            'password' => 'test-password',
            'scope' => '',
        ])->assertOk()->assertJsonPath('token_type', 'Bearer')
            ->assertJsonStructure(['access_token', 'refresh_token', 'expires_in']);
    }
}
