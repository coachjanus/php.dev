<ul>
    <li>
        <a href="/">Home</a>
    </li>
    <li>
        <a href="/about">About</a>
    </li>
    <li>
        <a href="/contact">Contact</a>
    </li>
</ul>

<?php



// echo '<h1>Hello world</h1>';

// $name = "John Doe";

// echo gettype($name).'<br>';


// $age = 22;
// echo gettype($age).'<br>';

// $width = 22.55;
// echo gettype($width).'<br>';

// $thisis = true;
// echo gettype($thisis).'<br>';

// $thisisnull = null;
// echo gettype($thisisnull).'<br>';

// var_dump($width);

// echo '<br>'.is_int($age).'<br>';
// echo is_bool($age).'<br>';

// var_dump(isset($width));
// var_dump(isset($width1));

// echo '<h2>User name is $name</h2>';
// echo "<h2>User name is $name</h2>";

// define('PI', 3.14);

// echo "<h2>This is const ".PI."</h2>";

// echo PHP_EOL; 
// var_dump(isset($width));
// echo PHP_EOL; 

// $a = 33;
// $b = 55;
// $c = 77;

// echo ($a + $b) * $c .PHP_EOL; // + - * / % 

// $a++;
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

// echo "<p>strlen: ".strlen($hello)."</p>";

// echo "<p>trim: ".trim($hello)."</p>";
// // ltrim rtrim 

// echo "<p>str_word_count: ".str_word_count($hello)."</p>";

// echo "<p>strtoupper: ".strtoupper($hello)."</p>";
// echo "<p>strtolower: ".strtolower($hello)."</p>";
// echo "<p>strpos: ".strpos($hello, 'world')."</p>";

// echo "<p>substr: ".substr($hello, 8)."</p>";
// echo "<p>str_replace: ".str_replace('Hello', 'Welcome', $hello)."</p>";

// // if else if else

// if ($age == 0) {
//     echo "Hello age";
// }
// elseif ($age == 10) {
//     echo "Blabla";
// }
// else {
//     echo "Oops";
// }

// echo "<p>age: ". $age ? $age : 0 ."</p>";

// echo "<p>age: ". $age ?:  0 ."</p>";

// echo "<hr>";

// echo $_SERVER['REQUEST_URI'];

function uri() {
    return $_SERVER['REQUEST_URI'];
}

switch (uri()) {
    case '/':
        echo "<h1>Home Page</h1>";
        echo '<h1>Hello world</h1>';

$name = "John Doe";

echo gettype($name).'<br>';


$age = 22;
echo gettype($age).'<br>';

$width = 22.55;
echo gettype($width).'<br>';

$thisis = true;
echo gettype($thisis).'<br>';

$thisisnull = null;
echo gettype($thisisnull).'<br>';

var_dump($width);

echo '<br>'.is_int($age).'<br>';
echo is_bool($age).'<br>';

var_dump(isset($width));
var_dump(isset($width1));

echo '<h2>User name is $name</h2>';
echo "<h2>User name is $name</h2>";

define('PI', 3.14);

echo "<h2>This is const ".PI."</h2>";

echo PHP_EOL; 
var_dump(isset($width));
echo PHP_EOL; 

$a = 33;
$b = 55;
$c = 77;

echo ($a + $b) * $c .PHP_EOL; // + - * / % 

$a++;
echo $a;

++$a;
echo $a;

$a--;
echo $a;

--$a;
echo $a;

echo "<h3>pow(2, 3): ".pow(2, 3)."</h3>";
// abs sqrt max min round floor ceil

$hello = "    Hello world    ";

echo "<p>strlen: ".strlen($hello)."</p>";

echo "<p>trim: ".trim($hello)."</p>";
// ltrim rtrim 

echo "<p>str_word_count: ".str_word_count($hello)."</p>";

echo "<p>strtoupper: ".strtoupper($hello)."</p>";
echo "<p>strtolower: ".strtolower($hello)."</p>";
echo "<p>strpos: ".strpos($hello, 'world')."</p>";

echo "<p>substr: ".substr($hello, 8)."</p>";
echo "<p>str_replace: ".str_replace('Hello', 'Welcome', $hello)."</p>";

// if else if else

if ($age == 0) {
    echo "Hello age";
}
elseif ($age == 10) {
    echo "Blabla";
}
else {
    echo "Oops";
}

echo "<p>age: ". $age ? $age : 0 ."</p>";

echo "<p>age: ". $age ?:  0 ."</p>";

echo "<hr>";

// echo $_SERVER['REQUEST_URI'];


        break;
        case '/about':
            echo "<h1>About Page</h1>";
            break;
            case '/contact':
                echo "<h1>Contact Page</h1>";
                break;
}