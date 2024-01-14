<?php require APPROOT . '/views/students/nav.php' ?>
<!DOCTYPE html>
<html lang="en">
<style>
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    @font-face {
        font-family: pop;
        src: url(./Fonts/Poppins-Medium.ttf);
    }

    .main{
        width: 100%;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        font-family: pop;
        flex-direction: column;
    }
    .head{
        text-align: center;
    }
    .head_1{
        font-size: 30px;
        font-weight: 600;
        color: #333;
    }
    .head_2 span{
        color: #ff4732;
    }
    .head_2{
        font-size: 16px;
        font-weight: 600;
        color: #333;
        margin-top: 3px;
    }
    ul{
        display: flex;
        margin-top: 80px;
    }
    ul li{
        list-style: none;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    ul li .icon{
        font-size: 35px;
        color: #ff4732;
        margin: 0 60px;
    }
    ul li .text{
        font-size: 14px;
        font-weight: 600;
        color: #ff4732;
    }

    /* Progress Div Css  */

    ul li .progress{
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background-color: rgba(68, 68, 68, 0.781);
        margin: 14px 0;
        display: grid;
        place-items: center;
        color: #fff;
        position: relative;
        cursor: pointer;
    }
    .progress::after{
        content: " ";
        position: absolute;
        width: 125px;
        height: 5px;
        background-color: rgba(68, 68, 68, 0.781);
        right: 30px;
    }
    .o1::after{
        width: 0;
        height: 0;
    }
    ul li .progress .uil{
        display: none;
    }
    ul li .progress p{
        font-size: 13px;
    }

    /* Active Css  */

    ul li .active{
        background-color: #ff4732;
        display: grid;
        place-items: center;
    }
    li .active::after{
        background-color: #ff4732;
    }
    ul li .active p{
        display: none;
    }
    ul li .active .uil{
        font-size: 20px;
        display: flex;
    }

    /* Responsive Css  */

    @media (max-width: 980px) {
        ul{
            flex-direction: column;
        }
        ul li{
            flex-direction: row;
        }
        ul li .progress{
            margin: 0 30px;
        }
        .progress::after{
            width: 5px;
            height: 55px;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            z-index: -1;
        }
        .o1::after{
            height: 0;
        }
        ul li .icon{
            margin: 15px 0;
        }
    }

    @media (max-width:600px) {
        .head .head_1{
            font-size: 24px;
        }
        .head .head_2{
            font-size: 16px;
        }
    }
</style>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['title'] ?></title>
    <link rel="stylesheet" href="style.css">

    <!-- UniIcon CDN Link  -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
</head>
<body>
    <div class="main">

        <div class="head">
            <p class="head_1"><?php echo $data['title'] ?> <span></span></p>
            <p class="head_2">Reward Points: <span><?php echo $data['points'] ?></span></p>
        </div>

        <ul>
            <?php $index = 0; ?>
            <?php foreach($data['rewards'] as $reward): ?>
            <?php $index++; ?>
            <li>
                <i class="icon uil uil-award"></i>
                <div class="progress <?php echo 'progress o' . ($index); ?>">
                    <p><?php echo $reward->RewardPoints ?></p>
                    <i class="uil uil-check"></i>
                </div>
                <p class="text"><?php echo $reward->RewardName ?></p>
            </li>
            <?php endforeach; ?>
        </ul>

    </div>

    <script>
        <?php for($i=1; $i<=$index; $i++): ?>
            const o<?php echo $i ?> = document.querySelector('.o<?php echo $i ?>');
        <?php endfor; ?>
        
        <?php for($i=1; $i<=$data['stage']; $i++): ?>
            o<?php echo $i ?>.classList.add('active');
        <?php endfor; ?>
    </script>
</body>
</html>
<?php require APPROOT . '/views/includes/footer.php'; ?>







