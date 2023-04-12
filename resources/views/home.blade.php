<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<link rel="stylesheet" href="{{ asset('/css/home.css') }}">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
 <div class="pc">
    <head>
        <div class="head">
         <h1>ChatApp</h1>
        </div> 
    </head>

    <main>
        <div class="side">
         <p>サイドバー</p>
        </div> 

        <div class="content">
         <p>メインコンテンツ</p>
        </div>
    </main>
 </div>


 <div class="sp">
    <head>
     <div class="sp-head">
        <h1>ChatApp</h1>
     </div>
    </head>

     <div class="sp-content">
        <p>メインコンテンツ</p>
     </div>
 </div>
</html>