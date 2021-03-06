<?php namespace App\Modules\Blogs\Controllers;

use App, View, Session,Auth,Validator,Input,Redirect,Lang;
use App\Modules\Blogs\Models\Blog;
use App\Modules\Blogs\Models\BlogCategory;
use App\Modules\Blogs\Models\BlogComment;
use App\Modules\Blogs\Models\ContentVote;
use App\Modules\Settings\Models\Setting;
use App\Modules\Users\Models\User;

class BlogsController extends \BaseController {
	
 /*function for plugins*/
	public function getBlogId(){
		return Blog::get(array('id','title'));
	}	
	
	public function getBlogGroupId(){
		return BlogCategory::get(array('id','title'));
	}
	
	public function newBlogs($params)
	{
		$param = $this->splitParams($params);
		$newBlogs = Blog::orderBy($param['order'],$param['sort'])->take($param['limit'])->select(array('id','title','slug'))->get();
		return View::make('blogs::site.newBlogs', compact('newBlogs'));
	}
	
	public function showBlogs($ids,$grids,$sorts,$limits,$orders)
	{
		$showBlogs = array();
		$ids = rtrim($ids, ",");

		if($ids!="" && $grids==""){
			$ids = rtrim($ids, ",");
			$ids = explode(',', $ids);
			
			$showBlogs = Blog::whereIn('id', $ids)->orderBy($orders,$sorts)->select(array('id','slug','title','content'))->get();
		}
		else if($limits!=0) {
			$showBlogs = Blog::orderBy($orders,$sorts)->take($limits)->select(array('id','slug','title','content'))->get();
		}
		return View::make('blogs::site.showBlogs', compact('showBlogs'));
	}
	
	public function getView($slug) {
		$settings = Setting::where('varname','pageitem')->first();
		
		$pageitem = ($settings -> value>0)?$settings -> value:2;
        // Get this blog blog data
		$blog = Blog::where('slug', '=', $slug) -> first();

		// Check if the blog blog exists
		if (is_null($blog)) {
			// If we ended up in here, it means that
			// a page or a blog blog didn't exist.
			// So, this means that it is time for
			// 404 error page.
			return App::abort(404);
		}

		// Get this blog comments
		$blog_comments = BlogComment::where('blog_id',$blog->id)->orderBy('created_at', 'ASC') -> paginate($pageitem);

		// Get current user and check permission
		$page = \App\Modules\Pages\Models\Page::first();
		$pagecontent = \BaseController::createSiderContent($page->id);
		
		$user = Auth::user();
		
		$canBlogComment = false;
		/*if (!empty($user)) {
			$canBlogComment = ($user['post_blog_comment']==1)?true:false;
		}*/
		
		$canBlogVote = false;
		/*if (!empty($user)) {
			$canBlogVote = ($user['post_blog_vote']==1)?true:false;
		}*/
	
		// Show the page
		$data['sidebar_right'] = $pagecontent['sidebar_right'];
		$data['sidebar_left'] = $pagecontent['sidebar_left'];
		$data['page'] = $page;
		$data['canBlogComment'] = $canBlogComment;
		$data['canBlogVote'] = $canBlogVote;
		$data['blog_comments'] = $blog_comments;
		$data['blog'] = $blog;
		return View::make('blogs::site/index', $data);
	}

	/**
	 * View a blog blog.
	 *
	 * @param  string  $slug
	 * @return Redirect
	 */
	public function postView($slug) {

		$user = $this -> user -> currentUser();
		if (!$user) {
			return Redirect::to('blog/'.$slug) -> with(Lang::get('site/blog.error'), Lang::get('site/blog.need_to_login'));
		}

		// Get this blog blog data
		$blog = Blog::where('slug', '=', $slug) -> first();
		// Check if the blog blog exists
		if (is_null($blog)) {
			// If we ended up in here, it means that
			// a page or a blog blog didn't exist.
			// So, this means that it is time for
			// 404 error page.
			return App::abort(404);
		}
		// Declare the rules for the form validation
		$rules = array('blogcomment' => 'required|min:3');

		// Validate the inputs
		$validator = Validator::make(Input::all(), $rules);

		// Check if the form validates with success
		if ($validator -> passes()) {
			// Save the comment
			$blog_comment = new BlogComment;
			$blog_comment -> user_id = Auth::user() -> id;
			$blog_comment -> blog_id = $blog -> id;
			$blog_comment -> content = Input::get('blogcomment');

			// Was the comment saved with success?
			if ($blog_comment -> save()) {
				// Redirect to this blog blog page
				return Redirect::to('blog/'.$slug) -> with(Lang::get('site/blog.success'), Lang::get('site/blog.comment_added'));
			}

			// Redirect to this blog blog page
			return Redirect::to('blog/'.$slug) -> with(Lang::get('site/blog.error'), Lang::get('site/blog.add_comment_error'));
		}

		// Redirect to this blog blog page
		return Redirect::to('blog/'.$slug) -> withInput() -> withErrors($validator);
	}

	public function contentvote()
	{
		$id = Input::get('id');
		$updown = Input::get('updown');
		$content = Input::get('content');
		$user = $this -> user -> currentUser();		
		$newvalue = 0;
		$exists = ContentVote::where('content','=',$content)
								->where('idcontent','=',$id)
								->where('user_id','=',$user->id)
								->get();
		switch ($content) {
			case 'blog':
				$item = Blog::find($id);
				break;
			case 'blogcomment':
				$item = BlogComment::find($id);
				break;		
		}
		$newvalue = $item->voteup - $item -> votedown;
		
		if($exists->count() == 0 ){
			$contentvote = new ContentVote;
			$contentvote -> user_id = $user->id;
			$contentvote -> updown = $updown;
			$contentvote -> content = $content;
			$contentvote -> idcontent = $id;
			$contentvote -> save();
			
			if($updown=='1')
				{
					$item -> voteup = $item -> voteup + 1;
					$item -> votedown = $item -> votedown;
				}
				else {
					$item -> votedown = $item -> votedown + 1;
					$item -> voteup = $item -> voteup;
				}
			
			$item->update();					
			$newvalue = $item->voteup - $item -> votedown;						
		}
		echo $newvalue;
	}
	 
}