<?php

namespace Mercury\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mercury\User;
use Mercury\Follower;
use Mercury\Post;
use Mercury\PostImage;
use Carbon\Carbon;
use Mercury\Wish;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['welcome', 'particles']);
    }

    public function welcome()
    {
        return view('welcome');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $allFollowers = Follower::allFollowers();
        $allFollowedByTheUser = Follower::allFollowedByTheUser();
        $posts = Post::tenPosts();
        $wishes = Wish::getWishes();
        $data = [
            'posts' => $posts
        ];

        return view('home')->with($data);
    }

    /**
     * load more posts based on the last is that was sent
     *
     * @param Request $request
     * @return void
     */
    public function loadMorePosts(Request $request)
    {
        return Post::loadMorePosts($request->lastId, $request->userId);
    }




    /**
     * IGNORE THIS
     * this for the particlesJs Lib
     *
     * @param string $jsonName
     * @return void
     */
    public function particles($jsonName)
    {
      $ranColor = array_rand([
        '#616161' => "grey darken-2", 
        "#004d40" => "teal darken-4", 
        // "#d50000" => "red accent-4", 
        "#4527a0" => "deep-purple darken-3", 
        // "#ffee58" => "yellow lighten-1", 
        "#00b0ff" => "light-blue accent-3", 
        "#37474f" => "blue-grey darken-3"
      ]);
      // $ranLineColor = array_rand([
      //   '#e0f7fa' => "cyan lighten-5", 
      //   "#d32f2f" => "red darken-2", 
      //   "#c2185b" => "pink darken-2", 
      //   "#616161" => "grey darken-2", 
      //   "#bf360c" => "deep-orange darken-4",
      //   "#01579b" => "light-blue darken-4", 
      //   "#311b92" => "deep-purple darken-4"
      // ]);
      $ranLineColor = array_rand([
        '#e0f7fa' => "cyan lighten-5", 
        // "#d32f2f" => "red darken-2", 
        "#eceff1" => "blue-grey lighten-5", 
        "#616161" => "grey darken-2", 
        "#81d4fa" => "light-blue lighten-3",
        "#01579b" => "light-blue darken-4", 
        "#c5cae9" => "indigo lighten-4"
      ]);
      // 616161
      $fixedColor = "#546e7a";
      switch ($jsonName) {
        case 'wlecome':
        $particles = [
          "howMuch" => 100,
          "color" => $ranColor,
          "line_color" => $ranLineColor,
          "shape" => "circle",
          "opacity" => 1,
          "size" => 3,
          "line_linked" => true,
          "direction" => "none",
          "mode" => "repulse"
        ];
          break;
        case 'login':
        $particles = [
          "howMuch" => 100,
          "color" => '#78909c',
          "line_color" => '#263238',
          "shape" => "circle",
          "opacity" => 1,
          "size" => 3,
          "line_linked" => true,
          "direction" => "none",
          "mode" => "repulse"
        ];
          break;
        case 'register':
        $particles = [
          "howMuch" => 100,
          "color" => '#78909c',
          "line_color" => '#263238',
          "shape" => "circle",
          "opacity" => 1,
          "size" => 3,
          "line_linked" => true,
          "direction" => "none",
          "mode" => "repulse"
        ];
          break;
        default:
          return response()->json(["On the wrong side 🤬🤬, don't miss with our server side monkeys" => "🐒🐒🐒🐒🐒🐒🐒🐒"]);
          break;
      }

      return json_encode(array (
        'particles' => 
        array (
          'number' => 
          array (
            'value' => $particles['howMuch'],
            'density' => 
            array (
              'enable' => true,
              'value_area' => 800,
            ),
          ),
          'color' => 
          array (
            'value' => $particles['color'],
          ),
          'shape' => 
          array (
            'type' => $particles['shape'],
          ),
          'opacity' => 
          array (
            'value' => $particles['opacity'],
            'random' => false,
          ),
          'size' => 
          array (
            'value' => $particles['size'],
            'random' => true,
            'anim' => 
            array (
              'size_min' =>0.1,
            ),
          ),
          'line_linked' => 
          array (
            'enable' => $particles['line_linked'],
            'distance' => 300,
            'color' => isset($particles['line_color']) ? $particles['line_color'] : "#0eb6cc",
            'opacity' => 0.4,
            'width' => 1,
          ),
          'move' => 
          array (
            'enable' => true,
            'speed' => 2,
            'direction' => $particles['direction'],
            'random' => false,
            'straight' => false,
            'out_mode' => 'out',
            'bounce' => false,
            'attract' => 
            array (
              'enable' => false,
              'rotateX' => 600,
              'rotateY' => 1200,
            ),
          ),
        ),
        'interactivity' => 
        array (
          'detect_on' => 'canvas',
          'events' => 
          array (
            'onhover' => 
            array (
              'enable' => true,
              'mode' => $particles['mode'],
            ),
            'onclick' => 
            array (
              'enable' => true,
              'mode' => 'push',
            ),
            'resize' => true,
          ),
          'modes' => 
          array (
            'grab' => 
            array (
              'distance' => 300,
              'line_linked' => 
              array (
                'opacity' => 1,
              ),
            ),
            'bubble' => 
            array (
              'distance' => 300,
              'size' => 80,
              'duration' => 2,
              'opacity' => 0.8000000000000000444089209850062616169452667236328125,
              'speed' => 3,
            ),
            'repulse' => 
            array (
              'distance' => 200,
              'duration' => 0.40000000000000002220446049250313080847263336181640625,
            ),
            'push' => 
            array (
              'particles_nb' => 4,
            ),
            'remove' => 
            array (
              'particles_nb' => 2,
            ),
          ),
        ),
        'retina_detect' => true,
    ));
  }
}