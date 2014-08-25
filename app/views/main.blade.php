<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laravel PHP Framework</title>

    <style>
        @import url(//fonts.googleapis.com/css?family=Lato:700);

        body {
            margin: 0;
            font-family: 'Lato', sans-serif;
            text-align: center;
            color: #999;
        }

        .welcome {
            width: 300px;
            height: 200px;
            position: absolute;
            left: 50%;
            top: 50%;
            margin-left: -150px;
            margin-top: -100px;
        }

        a, a:visited {
            text-decoration: none;
        }

        h1 {
            font-size: 32px;
            margin: 16px 0 16px 0;
        }

        /***FIRST STYLE THE BUTTON***/
        input#addNewButton {
            border: 2px groove #7c93ba;
            cursor: pointer; /*forces the cursor to change to a hand when the button is hovered*/
            padding: 0 20px;
            /*give the background a gradient - see cssdemos.tupence.co.uk/gradients.htm for more info*/
            background-color: #6b6dbb; /*required for browsers that don't support gradients*/
            /*style to the text inside the button*/
            font-family: Andika, Arial, sans-serif; /*Andkia is available at http://www.google.com/webfonts/specimen/Andika*/
            color: #fff;
            font-size: 1.1em;
            letter-spacing: .1em;
            font-variant: small-caps;
            /*give the corners a small curve*/
            -webkit-border-radius: 0 15px 15px 0;
            -moz-border-radius: 0 15px 15px 0;
            border-radius: 0 15px 15px 0;
            /*add a drop shadow to the button*/
            -webkit-box-shadow: rgba(0, 0, 0, .75) 0 2px 6px;
            -moz-box-shadow: rgba(0, 0, 0, .75) 0 2px 6px;
            box-shadow: rgba(0, 0, 0, .75) 0 2px 6px;
        }

        /***NOW STYLE THE BUTTON'S HOVER AND FOCUS STATES***/
        input#addNewButton:hover, input#addNewButton:focus {
            color: #edebda;
            /*reduce the spread of the shadow to give a pushed effect*/
            -webkit-box-shadow: rgba(0, 0, 0, .25) 0 1px 0;
            -moz-box-shadow: rgba(0, 0, 0, .25) 0 1px 0;
            box-shadow: rgba(0, 0, 0, .25) 0 1px 0;
        }

        .add_new_form input, .add_new_form textarea {
            padding: 1px 1px 1px 8px;
            height: 30px;
            border: 1px solid #aaa;
            box-shadow: 0 0 3px #ccc, 0 10px 15px #eee inset;
            border-radius: 2px;
        }

        .add_new_form input:focus, .add_new_form textarea:focus {
            background: #fff;
            border: 1px solid #555;
            box-shadow: 0 0 3px #aaa;
        }

        .list_snacks {
            margin-top: 16px;
        }

        .snack_list_item {
            padding: 8px;
            padding-bottom: 12px;
            padding-top: 12px;
            position: relative;
            overflow: hidden;
            border-bottom: 1px solid #aaa;;
        }

        .arrow-up {
            height: 0;
            float: right;
            border-left: 20px solid transparent;
            border-right: 20px solid transparent;
            border-bottom: 20px solid;
            border-bottom-color: lightgray;
        }

        .arrow-up:hover, .arrow-up:focus {
            border-bottom-color: lightgreen;
        }

        .arrow-down {
            height: 0;
            border-left: 20px solid transparent;
            border-right: 20px solid transparent;
            border-top: 20px solid;
            border-top-color: lightgray;
        }

        .arrow-down:hover, .arrow-down:focus {
            border-top-color: lightpink;
        }

        .snack_list_item_text {
            display: inline-block;
            *display: inline;
            zoom: 1;
        }

        .arrow-container {
            display: inline-block;
            position: relative;
            width: 15%%;
        }

        .arrow-value {
        }

        .snack-list-item-text-container {
            position: relative;
            width: 60%;
            display: inline-block;
            vertical-align: top;
            margin-top: 8px;
        }
    </style>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".arrow-up").click(function () {
                $(this).css("border-bottom-color", "green");
                var snackId = $(this).data('id');
                $("#snack-item-id-" + snackId).find(".arrow-down").css("border-top-color", "lightgray");
                vote(snackId, 1);
            });
            $(".arrow-down").click(function () {
                $(this).css("border-top-color", "red");
                var snackId = $(this).data('id');
                $("#snack-item-id-" + snackId).find(".arrow-up").css("border-bottom-color", "lightgray");
                vote(snackId, -1);
            });
        });

        function updateSnackItem(snack) {
            $("#down-arrow-container-" + snack.id).find(".arrow-value").html("-" + snack.downvotes);
            $("#up-arrow-container-" + snack.id).find(".arrow-value").html("+" + snack.upvotes);
            var sum_votes = snack.upvotes - snack.downvotes;
            $("#snack-item-id-" + snack.id).find(".snack_list_item_text").html(snack.name + " (" + sum_votes + ")");
        }
        function vote(snackId, value) {
            $.post("index.php/api/v1/vote",
                {id:snackId, value:value},
                function(data, textStatus, jqXHR)
                {
                    if (!data.error) {
                        updateSnackItem(data.snack);
                    }
                });
        }
    </script>
</head>
<body>

<div class="welcome">
    <h1>DD Snacks</h1>

    <form class="add_new_form">
        <input type="text" name="new_snack" placeholder="create a new snack">
        <input id="addNewButton" type="button" value="Add">
    </form>
    <div class="list_snacks">
        @foreach ($snacks as $snack)
            <div class="snack_list_item" id="snack-item-id-{{{ $snack->id }}}">
                <div class="arrow-container" id="down-arrow-container-{{{ $snack->id }}}">
                    <div class="arrow-down" data-id="{{{ $snack->id }}}"></div>
                    <div class="arrow-value">-{{{ $snack->downvotes }}}</div>
                </div>
                <div class="snack-list-item-text-container">
                    <div class="snack_list_item_text">{{{ $snack->name }}} ({{{ $snack->upvotes - $snack->downvotes }}})
                    </div>
                </div>
                <div class="arrow-container" id="up-arrow-container-{{{ $snack->id }}}">
                    <div class="arrow-up" data-id="{{{ $snack->id }}}"></div>
                    <div class="arrow-value">+{{{ $snack->upvotes }}}</div>
                </div>
            </div>
        @endforeach
    </div>
</div>
</body>
</html>
