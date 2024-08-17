<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;


class ThemeController extends Controller
{
    public function index()
    {
        $blogs = Blog::paginate(3);
        return view('theme.index', compact('blogs'));
    }
    public function contact()
    {
        return view('theme.contact');
    }
    public function category($id)
    {
        $blogs = Blog::where('category_id', $id)->paginate(8);
        $categoryTitle = Category::find($id)->name;
        return view('theme.category', compact('blogs', 'categoryTitle'));
    }
    // public function singleBlog()
    // {
    //     return view('theme.singleBlog');
    // }
    // ============================================
    //  Authentication
    // ============================================
    // ********* Login (get) ****************
    public function login()
    {
        return view('theme.login');
    }
    // ********* Login (post) ****************
    public function create(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return to_route('theme.home');
    }
    // ********* Register (get) ****************
    public function register()
    {
        return view('theme.register');
    }
    // ********* Register (post) ****************
    public function nRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:' . User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        // Auth::login($user);
        return to_route('theme.login')->with('welcome_msg', 'the registration process is complete and you can login');
    }
}
