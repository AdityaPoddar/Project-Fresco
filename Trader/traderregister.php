<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

                            <style>
                                    body
                                    {
                                        background-color:cadetblue;
                                    }
                                    .confirmation
                                    {
                                        display:flex;
                                        justify-content: center;
                                        align-items: center;
                                        flex-wrap:wrap;
                                        border: 2px transparent;
                                        border-radius:10px;
                                        width: 700px;
                                        margin-top:100px;
                                        margin-left:325px;
                                        background-color:khaki;
                                    }
                                    .top
                                    {
                                        padding-left:30px;
                                        padding-right:10px;
                                    }
                                    .top  h1
                                    {
                                        
                                        
                                        color:green;
                                        font-size:50px;
                                        
                                    }
                                    .line
                                    {
                                        border-top:2px solid purple;
                                        opacity: 0.3;
                                        width: 100%;;
                                    }
                                    .top h3
                                    {
                                        
                                        font-style: italic;
                                        color:blue;;
                                        font-size:30px;
                                        padding-bottom:30px;
                                        
                                    }
                                    .first
                                    {
                                        color:purple;
                                        padding-left: 130px;
                                    }
                                    .bottom input
                                    {
                                        padding:20px 30px;
                                        text-decoration: none;
                                        color:red;
                                        background-color: tomato;
                                        border:none;
                                        font-size:15px;
                                        margin-bottom:40px;
                                        cursor: pointer;
                                        line-height: 10px;
                                        text-align:center;
                                        color:purple;
                                        font-family: 'Times New Roman', Times, serif;
                                        border-radius: 10px;;
                                    }
                                    .bottom input:hover
                                    {
                                        color:whitesmoke;
                                        background-color:yellowgreen;
                                        
                                    }
                                    @media screen and (max-width: 720px)
                                    {
                                        .confirmation
                                        {
                                            
                                           
                                           margin:auto;
                                           margin-top:200px;
                                           flex-shrink: 2;
                                           flex-basis:100%;
                                        }
                                    }

                                    







                            </style>




</head>
<body>
                    <div class="confirmation">
                        <div class="top">
                                        <h1>WELCOME TO FRESCO</h1>
                                        <div class="line">

                                        </div>
                                        <br><br>
                                        <h3><span class="first">Thanks For Choosing Us.</span><br>Your Password has been provided in your mail.</h3>
                        </div>
                        <div class="bottom">
                        <form action="signin.php" method="">
                            <input type="submit" name="submit"  value="LOGIN" id="login"> 
                        </form>
                        </div>
                    </div>
    
</body>
</html>