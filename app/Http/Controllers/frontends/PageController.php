<?php
namespace App\Http\Controllers\frontends;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mail;
use App\Models\Post;
use App\Models\Page;
use App\Models\Plan;
use App\Models\Affiate;
use App\Models\PlanUser;
use App\Models\Transaction;

class PageController extends Controller{
    
	public function index(Request $request){
        $page = Page::leftJoin('posts','posts.id','=','pages.post_id')
						->select('title','image_id','excerpt','content','post_id','pages.id as id','meta_key','meta_value')
                        ->where('type','page')
                        ->where('template','home')->first();
        // $plans = Plan::leftJoin('posts','posts.id','=','plans.post_id')
        //                 ->select('title','image_id','post_id','plans.id as id','min_deposit','daily_profit')
        //                 ->where('type','plan')
        //                 ->where('status','public')->latest('posts.created_at')->get();
        $plans = Plan::postPublished()->orderBy('min_deposit', 'ASC')->get();
        $affiates = Affiate::leftJoin('posts','posts.id','=','affiates.post_id')
                        ->select('title','image_id','post_id','affiates.id as id','turnover','rewards')
                        ->where('type','affiate')
                        ->where('status','public')->latest('posts.created_at')->get();
        $deposits = PlanUser::with('user:id,displayname')->latest()->limit(6)->get();
        $withdrawals = Transaction::with('user:id,displayname')->complete()->withdraw()->latest()->limit(6)->get();
        $data = [
            'page'=>$page,
            'plans'=>$plans,
            'affiates'=>$affiates,
            'deposits'=>$deposits,
            'withdrawals'=>$withdrawals,
        ];
        $ref = $request->session()->get('referral_link');
        // if($ref) return $ref;
        //     else
		return view('frontends.index',$data);
	}

    public function slug(Request $request, $slug){ 
            $post = Post::where('slug',$slug)->first();
            if($post){ 
                switch ($post->type) {
                    case "page":
                        $page = Page::where('post_id',$post->id)->first();
                        if($page->template=="home"):
                            return redirect()->route('home');
                            break;
                        elseif($page->template=="default"):
                            $data = get_pageByTemplate($page->template,$page->post_id);
                            return view('frontends.pages.index',['data'=>$data]);
                            break;
                        else:
                            $data = get_pageByTemplate($page->template,$page->post_id);
                            return view('frontends.pages.'.$page->template,['data'=>$data]);
                            break;
                        endif;
                    case "investments":
                        return view('frontends.investments.index',['post'=>$post]);
                        break;
                    case "affiate":
                        return view('frontends.affiates.index',['post'=>$post]);
                        break;
                    case "plan":
                        return view('frontends.plans.index',['post'=>$post]);
                        break;
                    case "faq":
                        return view('frontends.faqs.index',['post'=>$post]);
                        break;
                    default:
                        return redirect()->route('home');
                        break;
                }
        }else{
            return redirect()->route($slug);
        }
    }
    public function sendContact(Request $request){
        $message = "error";
            //mail admin
            $content = '<ul>';
            $content .= '<li>Fullname: '.$request->name.'</li>';
            $content .= '<li>Phone: '.$request->phone.'</li>';
            $content .= '<li>Email: '.$request->email.'</li>';
            $content .= '</ul>';
            $content .= '<div>Message: '.$request->message.'</div>';
            $data = array( 'email' => $request->email, 'name' => $request->name, 'from' => get_option('email'), 'message'=> $content,'web'=>get_option('site_name'));
            Mail::send( 'frontends.mails.contact_admin', compact('data'), function( $message ) use ($data){
                $message->to($data['from'])
                        ->from( $data['email'], $data['name'] )
                        ->subject('[Contact from ] - '.$data['web']);
            });
            // //mail customer
            // $data = array( 'email' => $request->email, 'from' => mailSystem(),'name' => $request->name);
            // Mail::send( 'frontends.mails.contact', compact('data'), function( $message ) use ($data){
            //     $message->to($data['email'])
            //             ->from( $data['email'], $data['name'] )
            //             ->subject($data['web'].', Thank you for responding!');
            // });
            $request->session()->flash('success', 'Thank you for your request, we will get back to you as soon as possible.');
            return redirect()->route('sendContact');
    }
}