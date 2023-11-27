<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel ="stylesheet" href = "css/search.css">
</head>
<body>
<form action="Result.php" method="post">

<h1>条件検索</h1>
<p><div class="text"><input type="text" placeholder="商品名を入力" style="width: 300px;"  name="sname"></div></p>

<table class="table">
<tr><th><h3>地方</h3></th><th><h3>カテゴリー</h3></th><th><h3>価格帯</h3></th></tr>
<tr>

<td>
<label class="drop">
<select name='region'>
<option value='0'>使用しない</option>
<option value='1'>北海道</option>
<option value='2'>東北地方</option>
<option value='3'>関東地方</option>
<option value='4'>中部地方</option>
<option value='5'>近畿地方</option>
<option value='6'>中国地方</option>
<option value='7'>四国地方</option>
<option value='8'>九州地方</option>
</select>
</label>
</td>

<td>
<label class="drop">
<select name='category'>
<option value='0'>使用しない</option>
<option value='01'>生鮮食品</option>
<option value='02'>加工食品</option>
</select>
</label>
</td>

<td>
<label class="drop">
<select name='price'>
<option value='0'>使用しない</option>
<option value='price1'>0～2000</option>
<option value='price2'>2000～4000</option>
<option value='price3'>4000～6000</option>
<option value='price4'>6000～8000</option>
<option value='price5'>8000～10000</option>
<option value='price6'>10000～</option>
</select>
</label>
</td>

</tr>
</table>

<div class="button">
<input type="submit" value="検索">
</div>
</form>
</body>
</html>