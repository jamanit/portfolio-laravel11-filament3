<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\Experience;
use App\Models\Message;
use App\Models\Post;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use App\Mail\MessageMail;

class PortfolioController extends Controller
{
    public function index(string $username = null)
    {
        $user         = User::where('username', $username)->firstOrFail();
        $skills       = Skill::where('user_id', $user->id)->orderBy('id', 'desc')->limit(6)->get();
        $projects     = Project::where('user_id', $user->id)->orderBy('id', 'desc')->limit(6)->get();
        $educations   = Education::where('user_id', $user->id)->orderBy('id', 'desc')->limit(6)->get();
        $experiences  = Experience::where('user_id', $user->id)->orderBy('id', 'desc')->limit(6)->get();
        $testimonials = Testimonial::where('user_id', $user->id)->orderBy('id', 'desc')->limit(3)->get();
        $posts        = Post::where('user_id', $user->id)->where('status', 'Publish')->orderBy('id', 'desc')->limit(3)->get();

        if (!session()->has('viewed_portfolio_' . $user->id)) {
            $user->increment('portfolio_view');

            session(['viewed_portfolio_' . $user->id => true]);
        }

        return view('portfolio.index', compact(
            'user',
            'skills',
            'projects',
            'educations',
            'experiences',
            'testimonials',
            'posts',
        ));
    }

    public function project(string $username = null)
    {
        $user     = User::where('username', $username)->firstOrFail();
        $projects = Project::where('user_id', $user->id)->orderBy('id', 'desc')->paginate(10);

        return view('portfolio.project', compact(
            'user',
            'projects',
        ));
    }

    public function project_detail(string $username = null, string $id = null)
    {
        $user    = User::where('username', $username)->firstOrFail();
        $project = Project::findOrFail($id);

        return view('portfolio.project-detail', compact(
            'user',
            'project',
        ));
    }

    public function skill(string $username = null)
    {
        $user   = User::where('username', $username)->firstOrFail();
        $skills = Skill::where('user_id', $user->id)->orderBy('id', 'desc')->paginate(10);

        return view('portfolio.skill', compact(
            'user',
            'skills',
        ));
    }

    public function experience(string $username = null)
    {
        $user        = User::where('username', $username)->firstOrFail();
        $experiences = Experience::where('user_id', $user->id)->orderBy('id', 'desc')->paginate(10);

        return view('portfolio.experience', compact(
            'user',
            'experiences',
        ));
    }

    public function testimonial(string $username = null)
    {
        $user         = User::where('username', $username)->firstOrFail();
        $testimonials = Testimonial::where('user_id', $user->id)->orderBy('id', 'desc')->paginate(10);

        return view('portfolio.testimonial', compact(
            'user',
            'testimonials',
        ));
    }

    public function post(string $username = null)
    {
        $user  = User::where('username', $username)->firstOrFail();
        $posts = Post::where('user_id', $user->id)->where('status', 'Publish')->orderBy('id', 'desc')->paginate(10);

        return view('portfolio.post', compact(
            'user',
            'posts',
        ));
    }

    public function post_detail(string $username = null, string $id = null)
    {
        $user = User::where('username', $username)->firstOrFail();
        $post = Post::findOrFail($id);

        $post->increment('total_view');

        return view('portfolio.post-detail', compact(
            'user',
            'post',
        ));
    }

    public function message_store(Request $request)
    {
        $request->validate([
            'name'    => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]*$/'],
            'email'   => 'required|email|max:255',
            'message' => 'required|string|max:3000',
            'user_id' => 'required|integer',
        ], [
            'name.regex' => 'The name can only contain letters and spaces.',
        ]);

        $data = Message::create([
            'name'    => $request->name,
            'email'   => $request->email,
            'message' => strip_tags($request->input('message')),
            'user_id' => $request->user_id,
        ]);

        Mail::to([$request->destination_email])->send(new MessageMail($data));

        return response()->json([
            'status'  => 'success',
            'message' => 'Message sent successfully!',
        ]);
    }
}
