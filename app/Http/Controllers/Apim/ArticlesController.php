<?php

namespace App\Http\Controllers\Apim;

use App\Facades\FileProcessing;
use App\Http\Controllers\Controller;
use App\Models\ArticleInfo;
use App\Models\ArticleToArticleType;
use App\Models\ArticleToAuthor;
use App\Models\ArticleToCitation;
use App\Models\ArticleTypes;
use App\Models\Citations;
use App\Models\ArticleToFiles;
use App\Models\ArticleToKeyword;
use App\Models\Dosyalar;
use App\Models\Files;
use App\Models\Languages;
use App\Models\Subjects;
use App\Models\ArticleToSubject;
use App\Models\Types;
use App\Models\Keywords;
use App\Models\Volumes;
use App\Models\VolumeToFiles;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Articles;
use App\Models\Authors;
use Exception;
use Illuminate\Support\Facades\Storage;

class ArticlesController extends Controller
{
    public function index()
    {
        $itemPerPage = request()->query('itemPerPage');
        $query       = request()->query('query');

        $data = Articles::with([
            'user', 'articleInfos', 'volumes', 'volumes.journalto', 'authors', 'citations', 'keywords', 'files',
        ])->whereIn('status', [1, -5]);

        $journal_id = request()->query('journal_id');
        if ($journal_id) {
            $data = $data->whereHas('volumes', function ($query) use ($journal_id) {
                $query->whereHas('journalto', function ($query) use ($journal_id) {
                    $query->where('id', $journal_id);
                });
            });
        }

        $volume = request()->query('volume');
        if ($volume) {
            $data = $data->whereHas('volumes', function ($query) use ($volume) {
                $query->where('volume', '=', $volume);
            });
        }

        $issue = request()->query('issue');
        if ($issue) {
            $data = $data->whereHas('volumes', function ($query) use ($issue) {
                $query->where('issue', '=', $issue);
            });
        }

        $article = request()->query('article');
        if ($article) {
            $data = $data->where('order_num', '=', $article);
        }

        $author = request()->query('author');
        if ($author) {
            $data = $data->whereHas('authors', function ($query) use ($author) {
                $query->where('author_id', '=', $author);
            });
        }

        $keyword = request()->query('keyword');
        if ($keyword) {
            $data = $data->whereHas('keywords', function ($query) use ($keyword) {
                $query->where('keyword_id', '=', $keyword);
            });
        }

        $lang_id = request()->query('lang_id');
        if ($lang_id) {
            $data = $data->whereHas('articleInfos', function ($query) use ($lang_id) {
                $query->where('lang_id', '=', $lang_id);
            });
        }


        if ((auth('api')->check() && auth('api')->user()->role != 9)) {
            $data = $data->where('pap_creater', auth('api')->user()->id);
        }

        $year = request()->query('year');
        if ($year) {
            $data = $data->where('title_year', $year);
        }

        $sort = request()->query('sort');
        if ($sort) {
            $data = $data->orderBy($sort, request()->query('desc') == "true" ? 'desc' : 'ASC');
        }

        if ($query) {
            $data = $data->where(function ($query2) use ($query) {
                $query2
                    ->where('en_title', 'LIKE', '%'.$query.'%');
            });
        }

        if ($itemPerPage == -1) {
            $ret = [
                "data"      => $data->get(),
                "last_page" => 1
            ];
        } else {
            $ret = $data->paginate($itemPerPage);
        }
/*
        if ( ! auth('api')->check()) {
            foreach ($ret['data'] as $row) {
                foreach ($row["authors"] as $author) {
                    $author["email"] = null;
                }
            }
        }
*/
        return $ret;
    }

    public function show($id)
    {
        $all = Articles::with('user', 'authors', 'dosyalar', 'dosyalar.user', 'topic',
            'parampre', 'parampap', 'abstract_dosya', 'full_paper_dosya',
            'poster_presentation_dosya', 'icerikler', 'icerikler.user', 'video')->findOrFail($id);

        if ((auth('api')->check() && auth('api')->user()->role != 9 && $all->user->id !== auth('api')->user()->id) && ! $all->video_approved) {
            throw new Exception("Yetkiniz yok");
        }

        return $all;
    }


    private function findLang($code, $name = null, $rtl = null)
    {
        $Language = Languages::where('code', $code)->first();
        if ( ! $Language) {
            $Language = Languages::create([
                'code' => $code,
                'name' => $name,
                'rtl'  => $rtl ? 1 : 0,
            ]);
        }

        return $Language;
    }

    public function store(Request $request)
    {
        if ($request->json_file["id"] == null) {
            return [];
        }

        $dosya   = Dosyalar::where('id', $request->json_file["id"])->first();
        $rawData = Storage::cloud()->get($dosya["g_dosyaismi"]);

        $jsonValue = json_decode($rawData, true);

        //$volume = Volumes::where('d_id', $value['id'])->first();

        //$cover = isset($jsonValue['cover']) ? FileProcessing::download("https://dergipark.org.tr/media/cache/journal_header/".$jsonValue['cover']) : null;

        // Volumes & Issues
        $volume = Volumes::create([
            'journal_id'           => $request->id,
            'json_id'        => $dosya['id'],
            'd_id'           => $jsonValue['id'],
            'volume'         => $jsonValue['volume'],
            'issue'          => $jsonValue['number'],
            'special'        => $jsonValue['special'] ? 1 : 0,
            "cover_id"       => null,
            'year'           => isset($jsonValue['year']) ? $jsonValue['year'] : null,
            'date_published' => Carbon::parse($jsonValue['date_published']),
            'season'         => isset($jsonValue['season']) ? $jsonValue['season'] : null,
            'supplement'     => $jsonValue['supplement'] ? 1 : 0,
            'created_by'     => auth('api')->user()->id
        ]);

        foreach ($jsonValue['issue_files'] as $value) {
            foreach ($value['translations'] as $val) {
                $lang = $this->findLang($val['locale']);
                $file = isset($value['file']) ? FileProcessing::download($value['file']) : null;

                $Vfiles = VolumeToFiles::where('d_id', $val['id'])->first();
                if ( ! $Vfiles) {
                    $Vfiles = VolumeToFiles::create([
                        'd_id'        => $val['id'],
                        'lang_id'     => $lang->id,
                        'volume_id'   => $volume->id,
                        'title'       => $val['title'],
                        'description' => $val['description'],
                        'file_id'     => $file->id,
                        'type'        => $value['type'],
                    ]);
                } else {
                    $Vfiles->update([
                        'lang_id'     => $lang->id,
                        'volume_id'   => $volume->id,
                        'title'       => $val['title'],
                        'description' => $val['description'],
                        'file_id'     => $file->id,
                        'type'        => $value['type'],
                    ]);
                }
            }
        }

        foreach ($jsonValue['articles'] as $value) {
            $lang = $this->findLang($value['primary_language']);

            $article = Articles::create([
                'd_id'             => $value['id'],
                'v_id'             => $volume->id,
                'status'           => $value['status'],
                'anonymous'        => $value['anonymous'] ? 1 : 0,
                'submission_date'  => $value['submission_date'],
                'acceptance_date'  => isset($value['acceptance_date']) ? $value['acceptance_date'] : null,
                'pubdate'          => isset($value['pubdate']) ? $value['pubdate'] : null,
                'first_page'       => $value['first_page'],
                'last_page'        => $value['last_page'],
                'primary_language' => $lang->id,
                'order_num'        => $value['order_num'],
                'volume'           => $jsonValue['volume'],
                'issue'            => $jsonValue['number'],
                'created_by'       => auth('api')->user()->id
            ]);

            foreach ($value['translations'] as $val) {
                $lang = $this->findLang($val['locale']);

                ArticleInfo::create([
                    'd_id'       => $val['id'],
                    'v_id'       => $volume->id,
                    'article_id' => $article->id,
                    'lang_id'    => $lang->id,
                    'title'      => isset($val['title']) ? $val['title'] : null,
                    'abstract'   => isset($val['abstract']) ? $val['abstract'] : null,
                    'created_by' => auth('api')->user()->id
                ]);


                // Keywords
                if (isset($val['title'])) {
                    $keywords = explode(",", $val['keywords']);
                    foreach ($keywords as $val) {
                        $keyword = Keywords::where('name', $val)->first();
                        if ( ! $keyword) {
                            $keyword = Keywords::create([
                                'lang_id' => $lang->id,
                                'name'    => $val,
                            ]);
                        }

                        ArticleToKeyword::insert([
                            'article_id' => $article->id,
                            'keyword_id' => $keyword->id,
                        ]);
                    }
                }
            }

            foreach ($value['article_type']['translations'] as $val) {

                $articleType = ArticleTypes::where('d_id', $val['id'])->first();
                $lang        = $this->findLang($val['locale']);
                if ( ! $articleType) {
                    $articleType = ArticleTypes::create([
                        'd_id'    => $val['id'],
                        'lang_id' => $lang->id,
                        'name'    => $val['name'],
                    ]);
                }

                ArticleToArticleType::insert([
                    'article_id'      => $article->id,
                    'article_type_id' => $articleType->id,
                ]);
            }

            foreach ($value['subjects'] as $valu) {
                foreach ($valu['translations'] as $val) {

                    $subject = Subjects::where('d_id', $val['id'])->first();
                    $lang    = $this->findLang($val['locale']);
                    if ( ! $subject) {
                        $subject = Subjects::create([ // Subject
                            'd_id'    => $val['id'],
                            'lang_id' => $lang->id,
                            'name'    => $val['subject'],
                        ]);
                    }

                    ArticleToSubject::insert([
                        'article_id' => $article->id,
                        'subject_id' => $subject->id,
                    ]);
                }
            }


            // ArticleCitations
            $y = 0;
            foreach ($value['citations'] as $val) {
                $citation = Citations::where('d_id', $val['id'])->first();
                if ( ! $citation) {
                    $citation = Citations::create([
                        'article_id' => $article->id,
                        'd_id'       => $val['id'],
                        'raw'        => preg_replace('(\\[\\d+\\] ?)', '', $val['raw']),
                        'type'       => $val['type'],
                        'order'      => ++$y, // sor ??
                    ]);
                }

                ArticleToCitation::insert([
                    'article_id'  => $article->id,
                    'citation_id' => $citation->id,
                ]);
            }


            // ArticleAuthors
            foreach ($value['article_authors'] as $author) {
                $_author = Authors::where('d_id', $author['author']['id'])->first();

                if ( ! $_author) {
                    $_author = Authors::create([
                        'd_id'        => $author['author']['id'],
                        'email'       => $author['author']['email'],
                        'first_name'  => $author['author']['first_name'],
                        'middle_name' => isset($author['author']['middle_name']) ? $author['author']['middle_name'] : null,
                        'last_name'   => $author['author']['last_name'],
                        'adress'      => isset($author['author']['adress']) ? $author['author']['adress'] : null,
                        'orcid'       => isset($author['author']['orcid']) ? $author['author']['orcid'] : null,
                    ]);
                }

                ArticleToAuthor::insert([
                    'article_id' => $article->id,
                    'author_id'  => $_author->id,
                    'order'      => $author['author_order'],
                ]);
            }

            // ArticleFiles
            foreach ($value['article_files'] as $files) {
                if (array_key_exists('file', $files)) {
                    $_file = Files::where('url', $files['file'])->first();
                    if ( ! $_file) {
                        $_file = isset($files['file']) ? FileProcessing::download($files['file']) : null;
                    }

                    ArticleToFiles::insert([
                        'article_id' => $article->id,
                        'file_id'    => $_file->id,
                    ]);
                }
            }

        }

        return response(null, 200);
    }

    public
    function update(
        Request $request,
        $id
    ) {
    }


    public
    function destroy(
        $id
    ) {
        $value = Articles::findOrFail($id);
        $value->delete();

        return response(null, 204);
    }
}
