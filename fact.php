<html>
    <body>
        <form action=""method="POST">
            <label>Enter number:</label>
            <input type="text"name="number">
            <input type="submit"value="FACTORIAL">
        </form>
    </body>
</html>
<?php
$n=$_POST['number'];
$f=1;

for ($i=1; $i<=$n; $i++)
{
    $f=$f * $i;
}
echo" factorial of $n is $f";
?>