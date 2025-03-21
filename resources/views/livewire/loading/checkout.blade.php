<div>
    <style>
        .parent { 
            background:#333;
            width:80vw;
            
         }
        .loader { 
            width:100%; 
            margin:0 auto;
            border-radius:10px;
            border:4px solid transparent;
            position:relative;
            padding:1px;
        }
        .loader:before {
            content:'';
            border:1px solid #fff; 
            border-radius:10px;
            position:absolute;
            top:-4px; 
            right:-4px; 
            bottom:-4px; 
            left:-4px;
        }
        .loader .loaderBar { 
            position:absolute;
            border-radius:10px;
            top:0;
            right:100%;
            bottom:0;
            left:0;
            background:#fff; 
            width:0;
            animation:borealisBar 2s linear infinite;
        }
        
        @keyframes borealisBar {
            0% {
                left:0%;
                right:100%;
                width:0%;
            }
            10% {
                left:0%;
                right:75%;
                width:25%;
            }
            90% {
                right:0%;
                left:75%;
                width:25%;
            }
            100% {
                left:100%;
                right:0%;
                width:0%;
            }
        }
    </style>
    
    <div class="parent">
        <div class="loader">
            <div class="loaderBar"></div>
        </div>
        
    </div>
    
</div>
