<?php

?>

<html>
<head>
    <style>
        #multiple_choice{
            visibility: visible;
        }
        #free_form{
            visibility: hidden;
        }
    </style>
</head>
<body>
    <input type="radio" name="form_type" value="multiple_choice" checked="true">Multiple Choice<br>
    <input type="radio" name="form_type" value="free_form">Free Form<br>
    <form action="write_bets_intermediary.php" method="post">
        <div id="multiple_choice">
            <div>
                <p>Type of bet</p>
                <label><input type="radio" name="bet_type" value="spread" checked="true">spread</label><br>
                <label><input type="radio" name="bet_type" value="moneyline">moneyline</label><br>
                <label><input type="radio" name="bet_type" value="over/under">over/under</label>
            </div>
            <div>
                <p>first side</p>
                <label><input type="radio" name="first_side" value="true" checked="true">true</label><br>
                <label><input type="radio" name="first_side" value="false">false</label>
            </div>
            <div>
                <p>odds</p>
                <label><input type="radio" name="odds" value="110" checked="true">110</label><br>
                <label><input type="radio" name="odds" value="100">100</label><br>
                <label><input type="radio" name="odds" value="-100">-100</label><br>
                <label><input type="radio" name="odds" value="-110">-110</label><br>
                <label><input type="radio" name="odds" value="-250">-250</label><br>
                <label><input type="radio" name="odds" value="-350">-350</label><br>
            </div>
            <div>
                <p>line</p>
                <label><input type="radio" name="line" value="-7" checked="true">-7</label><br>
                <label><input type="radio" name="line" value="7">7</label><br>
                <label><input type="radio" name="line" value="-10">-10</label><br>
                <label><input type="radio" name="line" value="10">10</label><br>
                <label><input type="radio" name="line" value="45">45</label><br>
                <label><input type="radio" name="line" value="76">76</label><br>
            </div>
            <br><button>submit</button>
        </div>
        <div id="free_form">

        </div>
    </form>
</body>
</html>
