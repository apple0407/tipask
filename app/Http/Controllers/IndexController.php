<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Notice;
use App\Models\Question;
use App\models\Tag;
use App\models\UserData;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
       // echo intval(str_shuffle('0123456789'));
        $setting = Setting()->get('website.name');
      //  print_r($setting);
//        $data = ['email'=>'sky_php@qq.com', 'name'=>'sky_php', 'uid'=>3, 'activationcode'=>'asdfassssssss'];
//
//        Mail::queue('emails.validate', $data, function($message) use ($data)
//        {
//            $message->to($data['email'], $data['name'])->subject('请验证您在Tipask问答网注册的邮箱！');
//        });




        /*活跃用户*/
        $activeUsers = Cache::remember('active_users',10,function() {
               return  UserData::activities(8);
        });

        /*热门问题*/
        $hotQuestions = Cache::remember('hot_questions',10,function() {
            return  Question::hottest(8);
        });

        /*悬赏问题*/
        $rewardQuestions = Cache::remember('reward_questions',10,function() {
            return  Question::reward(8);
        });

        /*热门文章*/
        $hotArticles = Cache::remember('hot_articles',10,function() {
            return  Article::hottest(8);
        });

        /*最新文章*/
        $newestArticles = Cache::remember('newest_articles',10,function() {
            return  Article::newest(8);
        });


        /*最新公告*/
        $newestNotices = Cache::remember('newest_notices',10,function() {
            return  Notice::where('status','>','0')->orderBy('updated_at','DESC')->take(8)->get();
        });



        /*财富榜*/
        $topCoinUsers = Cache::remember('top_coin_users',10,function() {
            return  UserData::topCoins(8);
        });



        return view('theme::home.index')->with('activeUsers',$activeUsers)
                                        ->with('hotQuestions',$hotQuestions)
                                        ->with('rewardQuestions',$rewardQuestions)
                                        ->with('hotArticles',$hotArticles)
                                        ->with('newestArticles',$newestArticles)
                                        ->with('newestNotices',$newestNotices)
                                        ->with('topCoinUsers',$topCoinUsers);

    }


    /*问答模块*/
    public function ask($filter='newest')
    {

        $question = new Question();

        if(!method_exists($question,$filter)){
            abort(404);
        }

        $questions =  call_user_func([$question,$filter]);

        $hotQuestions = Question::recent();
        return view('theme::home.ask')->with('questions',$questions)
            ->with('hotQuestions',$hotQuestions)
            ->with('filter',$filter);
    }


    public function blog($filter='recommended')
    {
        $article = new Article();
        if(!method_exists($article,$filter)){
            abort(404);
        }

        $articles = call_user_func([$article,$filter]);

        $hotUsers = UserData::activeInArticles();

        return view('theme::home.blog')->with('articles',$articles)
                                       ->with('hotUsers',$hotUsers)
                                       ->with('filter',$filter);
    }

    public function topic()
    {
        $topics = Tag::orderBy('followers','DESC')->paginate(20);
        return view('theme::home.topic')->with('topics',$topics);
    }

}