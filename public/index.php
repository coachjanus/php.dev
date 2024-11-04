<!-- <ul>
    <li>
        <a href="/">Home</a>
    </li>
    <li>
        <a href="/about">About</a>
    </li>
    <li>
        <a href="/contact">Contact</a>
    </li>
</ul> -->

<?php
// echo "<hr>";


// echo '<h1>Hello world</h1>';
// $name = "John Doe";
// $Name = "John Doe";
// $_Name = "John Doe";
// $__Name1 = "John Doe";
// echo '$name';
// echo "$Name";
// echo "<hr>";
// echo gettype($name).'<br>';

// echo "<hr>";

// $age = 22;
// echo gettype($age).'<br>';

// // $width = 22.55;
// // echo gettype($width).'<br>';
// // var_dump($width); // float

// echo PHP_EOL; 
// echo "<br>";
// var_dump(isset($width));
// echo "<br>";
// echo PHP_EOL; 

// $this_is = true;
// echo gettype($this_is).'<br>';

// $this_is_null = null;
// echo gettype($this_is_null).'<br>';

// // echo '<br>'.is_int($age).'<br>';
// echo is_int($age); // 1 = true
// echo is_bool($this_is); // 1 = frue

// // var_dump(isset($width));
// // var_dump(isset($width1));

// // echo '<h2>User name is $name</h2>';
// // echo "<h2>User name is $name</h2>";

// define('PI', 3.14);
// // concatenation +
// echo "<h2>This is const ".PI."</h2>";
// // echo "<h2>This is const" + PI + "</h2>";
// echo DIRECTORY_SEPARATOR; // / - unix \ - windows
// echo DIRECTORY_SEPARATOR."home".DIRECTORY_SEPARATOR."dev";
// $a = 33;
// $b = 55;
// $c = 77;

// echo ($a + $b) * $c .PHP_EOL; // + - * / % 

// $a++;
// $a = $a +1;
// echo $a;

// ++$a;
// echo $a;

// $a--;
// echo $a;

// --$a;
// echo $a;


// echo "<h3>pow(2, 3): ".pow(2, 3)."</h3>";
// // abs sqrt max min round floor ceil

// $hello = "    Hello world    ";
// echo $hello;
// echo "<p>strlen: ".strlen($hello)."</p>";
// echo $hello;
// $trim = trim($hello);
// // echo "<p>trim: ".trim($hello)."</p>";
// echo "<p>strlen: ".strlen($trim)."</p>";
// // // ltrim rtrim 

// echo "<p>str_word_count: ".str_word_count($hello)."</p>";

// echo "<p>strtoupper: ".strtoupper($hello)."</p>";
// echo "<p>strtolower: ".strtolower($hello)."</p>";
// echo "<p>strpos: ".strpos($hello, 'world')."</p>";

// echo "<p>substr: ".substr($hello, 8)."</p>";
// echo "<p>str_replace: ".str_replace('Hello', 'Welcome', $hello)."</p>";

// // // if else if else

// if ($age == 0) {
//     echo "Hello age";
// }
// elseif ($age == 10) {
//     echo "Blabla";
// }
// else {
//     echo "Oops";
// }
// $age = $age ? $age : 0;
// echo "<p>age: $age </p>";

// echo "<p>age: ". $age ?:  0 ."</p>";

// echo "<hr>";

// echo $_SERVER['REQUEST_URI'];

//====================================



// function uri() {
//     return $_SERVER['REQUEST_URI'];
// }

// echo __DIR__;
// echo dirname(__DIR__);
require_once dirname(__DIR__).DIRECTORY_SEPARATOR.'bootstrap'.DIRECTORY_SEPARATOR.'app.php';
// /home/janus/projects/dev/bootstrap


// switch (uri()) {
//     case '/':b 
//         echo "<h1>Home Page</h1>";
//         // echo '<h1>Hello world</h1>';
//         break;
//     case '/about':
//         echo "<h1>About Page</h1>";
//         break;
//     case '/contact':
//         echo "<h1>Contact Page</h1>";
//         break;
// }