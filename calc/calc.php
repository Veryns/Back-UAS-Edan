<?php
$result = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $num1 = (float) $_POST['num1'];
    $num2 = (float) $_POST['num2'];
    $op = $_POST['op'];
    
    switch ($op) {
        case '+': $result = $num1 + $num2; break;
        case '-': $result = $num1 - $num2; break;
        case '*': $result = $num1 * $num2; break;
        case '/': $result = $num2 != 0 ? $num1 / $num2 : 'Error'; break;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Calculator</title>
</head>
<body>
    <h2>Calculator</h2>
    <form method="POST">
        <input type="number" name="num1" placeholder="Number 1" required>
        <input type="number" name="num2" placeholder="Number 2" required>
        <select name="op" required>
            <option value="+">+</option>
            <option value="-">-</option>
            <option value="*">*</option>
            <option value="/">÷</option>
        </select>
        <button>Calculate</button>
    </form>
    <?php if ($result !== ''): ?>       
        <p>Result: <strong><?php echo $result; ?></strong></p>
    <?php endif; ?>
</body>
</html>