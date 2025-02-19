<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Http\Request;

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

        return view('portfolio.index', compact(
            'user',
            'skills',
            'projects',
            'educations',
            'experiences',
            'testimonials',
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
}
