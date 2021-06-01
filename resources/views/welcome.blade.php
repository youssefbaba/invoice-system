@extends('layouts.home')
@section('contenu_home')
<nav class="navbar navbar-expand-md navbar-light p-0">
    <a class="navbar-brand" href="{{ url('/') }}">
            {{-- <img src="{{asset('css/Logo 6.svg')}}" alt="fatoura"  height="60" width="200"> --}}
            <svg width="200" height="60" viewBox="0 0 438 107" fill="none">
                <path d="M0.957397 15.3192C0.957397 6.85862 7.81602 0 16.2765 0H74.6808C83.1413 0 90 6.85862 90 15.3192C90 23.7797 83.1414 30.6383 74.6808 30.6383H16.2766C7.81603 30.6383 0.957397 23.7797 0.957397 15.3192Z" fill="#2262C6"/>
                <path d="M30.6383 15.3192C30.6383 6.85862 37.4969 0 45.9575 0H74.6809C83.1414 0 90 6.85862 90 15.3192C90 23.7797 83.1414 30.6383 74.6809 30.6383H45.9575C37.4969 30.6383 30.6383 23.7797 30.6383 15.3192Z" fill="#427FDE"/>
                <path d="M50.7446 15.3192C50.7446 6.85862 57.6033 0 66.0638 0H74.6808C83.1413 0 90 6.85862 90 15.3192C90 23.7797 83.1413 30.6383 74.6808 30.6383H66.0638C57.6032 30.6383 50.7446 23.7797 50.7446 15.3192Z" fill="#FFC5A0"/>
                <path d="M15.3192 104.277C6.85862 104.277 0 97.418 0 88.9575V65.9787C0 57.5182 6.85862 50.6596 15.3192 50.6596C23.7797 50.6596 30.6383 57.5182 30.6383 65.9787V88.9575C30.6383 97.418 23.7797 104.277 15.3192 104.277Z" fill="#FFC5A0"/>
                <path d="M15.3192 88.9575C6.85862 88.9575 0 82.0989 0 73.6384V50.6596C0 42.1991 6.85862 35.3405 15.3192 35.3405C23.7797 35.3405 30.6383 42.1991 30.6383 50.6596V73.6384C30.6383 82.0989 23.7797 88.9575 15.3192 88.9575Z" fill="#2262C6"/>
                <path d="M0 50.6596C0 42.1991 6.85862 35.3405 15.3192 35.3405H44.0426C52.5031 35.3405 59.3617 42.1991 59.3617 50.6596C59.3617 59.1201 52.5031 65.9788 44.0426 65.9788H15.3192C6.85862 65.9788 0 59.1201 0 50.6596Z" fill="#427FDE"/>
                <path d="M87.6601 78H95.3551V59.28H99.4951V52.89H95.3551V52.665C95.3551 50.01 96.3901 49.11 99.3601 49.29V42.765C91.7101 42.36 87.6601 45.6 87.6601 52.17V52.89H84.8701V59.28H87.6601V78ZM102.931 65.4C102.931 73.32 107.836 78.36 113.956 78.36C117.691 78.36 120.346 76.65 121.741 74.445V78H129.436V52.89H121.741V56.445C120.391 54.24 117.736 52.53 114.001 52.53C107.836 52.53 102.931 57.48 102.931 65.4ZM121.741 65.445C121.741 69.45 119.176 71.655 116.251 71.655C113.371 71.655 110.761 69.405 110.761 65.4C110.761 61.395 113.371 59.235 116.251 59.235C119.176 59.235 121.741 61.44 121.741 65.445ZM137.568 69.27C137.568 75.795 141.213 78 146.433 78H150.348V71.475H147.603C145.893 71.475 145.263 70.845 145.263 69.36V59.28H150.303V52.89H145.263V46.77H137.568V52.89H134.508V59.28H137.568V69.27ZM180.554 65.445C180.554 57.48 174.884 52.53 167.504 52.53C160.169 52.53 154.454 57.48 154.454 65.445C154.454 73.41 160.034 78.36 167.414 78.36C174.794 78.36 180.554 73.41 180.554 65.445ZM162.284 65.445C162.284 61.17 164.714 59.19 167.504 59.19C170.204 59.19 172.724 61.17 172.724 65.445C172.724 69.675 170.159 71.7 167.414 71.7C164.624 71.7 162.284 69.675 162.284 65.445ZM210.781 52.89H203.086V66.525C203.086 69.945 201.196 71.835 198.226 71.835C195.346 71.835 193.411 69.945 193.411 66.525V52.89H185.761V67.56C185.761 74.265 189.676 78.27 195.481 78.27C198.856 78.27 201.556 76.74 203.086 74.58V78H210.781V52.89ZM225.354 66.345C225.354 62.025 227.469 60.765 231.114 60.765H233.229V52.62C229.854 52.62 227.109 54.42 225.354 57.075V52.89H217.659V78H225.354V66.345ZM236.727 65.4C236.727 73.32 241.632 78.36 247.752 78.36C251.487 78.36 254.142 76.65 255.537 74.445V78H263.232V52.89H255.537V56.445C254.187 54.24 251.532 52.53 247.797 52.53C241.632 52.53 236.727 57.48 236.727 65.4ZM255.537 65.445C255.537 69.45 252.972 71.655 250.047 71.655C247.167 71.655 244.557 69.405 244.557 65.4C244.557 61.395 247.167 59.235 250.047 59.235C252.972 59.235 255.537 61.44 255.537 65.445Z" fill="#2262C6"/>
                <path id="text" d="M88.6767 95.04L92.9767 106H95.0967L99.3967 95.04H97.4567L94.0567 104.32L90.6367 95.04H88.6767ZM112.188 100.5C112.188 97.04 109.768 94.86 106.648 94.86C103.548 94.86 101.108 97.04 101.108 100.5C101.108 103.98 103.468 106.18 106.568 106.18C109.688 106.18 112.188 103.98 112.188 100.5ZM102.968 100.5C102.968 97.74 104.708 96.44 106.628 96.44C108.508 96.44 110.328 97.74 110.328 100.5C110.328 103.28 108.468 104.58 106.568 104.58C104.668 104.58 102.968 103.28 102.968 100.5ZM115.581 103C115.581 105.2 116.681 106 118.621 106H120.261V104.46H118.921C117.801 104.46 117.401 104.08 117.401 103V96.54H120.261V95.04H117.401V92.28H115.581V95.04H114.161V96.54H115.581V103ZM124.886 100.04C124.886 97.5 126.206 96.72 127.946 96.72H128.426V94.84C126.686 94.84 125.506 95.6 124.886 96.82V95.04H123.066V106H124.886V100.04ZM135.787 96.4C137.667 96.4 139.267 97.58 139.247 99.72H132.327C132.527 97.58 134.007 96.4 135.787 96.4ZM140.907 102.62H138.947C138.547 103.8 137.507 104.64 135.867 104.64C134.007 104.64 132.447 103.42 132.307 101.2H141.067C141.107 100.82 141.127 100.5 141.127 100.1C141.127 97.1 139.047 94.86 135.867 94.86C132.667 94.86 130.447 97.04 130.447 100.5C130.447 103.98 132.747 106.18 135.867 106.18C138.587 106.18 140.347 104.62 140.907 102.62ZM160.461 100.5C160.461 97.04 158.041 94.86 154.921 94.86C151.821 94.86 149.381 97.04 149.381 100.5C149.381 103.98 151.741 106.18 154.841 106.18C157.961 106.18 160.461 103.98 160.461 100.5ZM151.241 100.5C151.241 97.74 152.981 96.44 154.901 96.44C156.781 96.44 158.601 97.74 158.601 100.5C158.601 103.28 156.741 104.58 154.841 104.58C152.941 104.58 151.241 103.28 151.241 100.5ZM173.174 95.04H171.354V101.06C171.354 103.42 170.094 104.58 168.214 104.58C166.374 104.58 165.154 103.44 165.154 101.22V95.04H163.354V101.46C163.354 104.6 165.334 106.16 167.854 106.16C169.314 106.16 170.654 105.52 171.354 104.38V106H173.174V95.04ZM177.247 103C177.247 105.2 178.347 106 180.287 106H181.927V104.46H180.587C179.467 104.46 179.067 104.08 179.067 103V96.54H181.927V95.04H179.067V92.28H177.247V95.04H175.827V96.54H177.247V103ZM184.732 106H186.552V95.04H184.732V106ZM185.672 93.26C186.332 93.26 186.872 92.72 186.872 92.02C186.872 91.32 186.332 90.78 185.672 90.78C184.972 90.78 184.432 91.32 184.432 92.02C184.432 92.72 184.972 93.26 185.672 93.26ZM190.254 106H192.074V91.2H190.254V106ZM201.028 100.48C201.028 103.88 203.288 106.18 206.228 106.18C208.228 106.18 209.648 105.16 210.308 103.94V106H212.148V91.2H210.308V97C209.548 95.74 207.968 94.86 206.248 94.86C203.288 94.86 201.028 97.06 201.028 100.48ZM210.308 100.5C210.308 103.08 208.588 104.58 206.588 104.58C204.588 104.58 202.888 103.06 202.888 100.48C202.888 97.9 204.588 96.44 206.588 96.44C208.588 96.44 210.308 97.96 210.308 100.5ZM220.484 96.4C222.364 96.4 223.964 97.58 223.944 99.72H217.024C217.224 97.58 218.704 96.4 220.484 96.4ZM225.604 102.62H223.644C223.244 103.8 222.204 104.64 220.564 104.64C218.704 104.64 217.144 103.42 217.004 101.2H225.764C225.804 100.82 225.824 100.5 225.824 100.1C225.824 97.1 223.744 94.86 220.564 94.86C217.364 94.86 215.144 97.04 215.144 100.5C215.144 103.98 217.444 106.18 220.564 106.18C223.284 106.18 225.044 104.62 225.604 102.62ZM235.098 106H236.918V96.54H239.218V95.04H236.918V94.26C236.918 92.84 237.458 92.24 239.098 92.24V90.72C236.298 90.72 235.098 91.82 235.098 94.26V95.04H233.678V96.54H235.098V106ZM241.26 100.48C241.26 103.88 243.52 106.18 246.44 106.18C248.46 106.18 249.88 105.14 250.54 103.96V106H252.38V95.04H250.54V97.04C249.9 95.9 248.5 94.86 246.46 94.86C243.52 94.86 241.26 97.06 241.26 100.48ZM250.54 100.5C250.54 103.08 248.82 104.58 246.82 104.58C244.82 104.58 243.12 103.06 243.12 100.48C243.12 97.9 244.82 96.44 246.82 96.44C248.82 96.44 250.54 97.96 250.54 100.5ZM255.376 100.5C255.376 103.98 257.596 106.18 260.716 106.18C263.436 106.18 265.216 104.66 265.776 102.48H263.816C263.416 103.86 262.336 104.64 260.716 104.64C258.716 104.64 257.236 103.22 257.236 100.5C257.236 97.82 258.716 96.4 260.716 96.4C262.336 96.4 263.436 97.24 263.816 98.56H265.776C265.216 96.26 263.436 94.86 260.716 94.86C257.596 94.86 255.376 97.06 255.376 100.5ZM269.204 103C269.204 105.2 270.304 106 272.244 106H273.884V104.46H272.544C271.424 104.46 271.024 104.08 271.024 103V96.54H273.884V95.04H271.024V92.28H269.204V95.04H267.784V96.54H269.204V103ZM286.409 95.04H284.589V101.06C284.589 103.42 283.329 104.58 281.449 104.58C279.609 104.58 278.389 103.44 278.389 101.22V95.04H276.589V101.46C276.589 104.6 278.569 106.16 281.089 106.16C282.549 106.16 283.889 105.52 284.589 104.38V106H286.409V95.04ZM291.902 100.04C291.902 97.5 293.222 96.72 294.962 96.72H295.442V94.84C293.702 94.84 292.522 95.6 291.902 96.82V95.04H290.082V106H291.902V100.04ZM297.463 100.48C297.463 103.88 299.723 106.18 302.643 106.18C304.663 106.18 306.083 105.14 306.743 103.96V106H308.583V95.04H306.743V97.04C306.103 95.9 304.703 94.86 302.663 94.86C299.723 94.86 297.463 97.06 297.463 100.48ZM306.743 100.5C306.743 103.08 305.023 104.58 303.023 104.58C301.023 104.58 299.323 103.06 299.323 100.48C299.323 97.9 301.023 96.44 303.023 96.44C305.023 96.44 306.743 97.96 306.743 100.5ZM312.659 103C312.659 105.2 313.759 106 315.699 106H317.339V104.46H315.999C314.879 104.46 314.479 104.08 314.479 103V96.54H317.339V95.04H314.479V92.28H312.659V95.04H311.239V96.54H312.659V103ZM320.144 106H321.964V95.04H320.144V106ZM321.084 93.26C321.744 93.26 322.284 92.72 322.284 92.02C322.284 91.32 321.744 90.78 321.084 90.78C320.384 90.78 319.844 91.32 319.844 92.02C319.844 92.72 320.384 93.26 321.084 93.26ZM336.066 100.5C336.066 97.04 333.646 94.86 330.526 94.86C327.426 94.86 324.986 97.04 324.986 100.5C324.986 103.98 327.346 106.18 330.446 106.18C333.566 106.18 336.066 103.98 336.066 100.5ZM326.846 100.5C326.846 97.74 328.586 96.44 330.506 96.44C332.386 96.44 334.206 97.74 334.206 100.5C334.206 103.28 332.346 104.58 330.446 104.58C328.546 104.58 326.846 103.28 326.846 100.5ZM347.079 106H348.879V99.54C348.879 96.4 346.939 94.84 344.399 94.84C342.919 94.84 341.599 95.46 340.879 96.6V95.04H339.059V106H340.879V99.94C340.879 97.58 342.159 96.42 344.019 96.42C345.859 96.42 347.079 97.56 347.079 99.8V106ZM363.044 96.4C364.924 96.4 366.524 97.58 366.504 99.72H359.584C359.784 97.58 361.264 96.4 363.044 96.4ZM368.164 102.62H366.204C365.804 103.8 364.764 104.64 363.124 104.64C361.264 104.64 359.704 103.42 359.564 101.2H368.324C368.364 100.82 368.384 100.5 368.384 100.1C368.384 97.1 366.304 94.86 363.124 94.86C359.924 94.86 357.704 97.04 357.704 100.5C357.704 103.98 360.004 106.18 363.124 106.18C365.844 106.18 367.604 104.62 368.164 102.62ZM371.786 103C371.786 105.2 372.886 106 374.826 106H376.466V104.46H375.126C374.006 104.46 373.606 104.08 373.606 103V96.54H376.466V95.04H373.606V92.28H371.786V95.04H370.366V96.54H371.786V103ZM384.523 100.48C384.523 103.88 386.783 106.18 389.723 106.18C391.723 106.18 393.143 105.16 393.803 103.94V106H395.643V91.2H393.803V97C393.043 95.74 391.463 94.86 389.743 94.86C386.783 94.86 384.523 97.06 384.523 100.48ZM393.803 100.5C393.803 103.08 392.083 104.58 390.083 104.58C388.083 104.58 386.383 103.06 386.383 100.48C386.383 97.9 388.083 96.44 390.083 96.44C392.083 96.44 393.803 97.96 393.803 100.5ZM403.979 96.4C405.859 96.4 407.459 97.58 407.439 99.72H400.519C400.719 97.58 402.199 96.4 403.979 96.4ZM409.099 102.62H407.139C406.739 103.8 405.699 104.64 404.059 104.64C402.199 104.64 400.639 103.42 400.499 101.2H409.259C409.299 100.82 409.319 100.5 409.319 100.1C409.319 97.1 407.239 94.86 404.059 94.86C400.859 94.86 398.639 97.04 398.639 100.5C398.639 103.98 400.939 106.18 404.059 106.18C406.779 106.18 408.539 104.62 409.099 102.62ZM411.021 95.04L415.321 106H417.441L421.741 95.04H419.801L416.401 104.32L412.981 95.04H411.021ZM424.132 106H425.952V95.04H424.132V106ZM425.072 93.26C425.732 93.26 426.272 92.72 426.272 92.02C426.272 91.32 425.732 90.78 425.072 90.78C424.372 90.78 423.832 91.32 423.832 92.02C423.832 92.72 424.372 93.26 425.072 93.26ZM437.534 103.02C437.454 99.1 431.094 100.52 431.094 97.92C431.094 97.04 431.894 96.4 433.234 96.4C434.694 96.4 435.534 97.2 435.614 98.3H437.434C437.314 96.16 435.714 94.86 433.294 94.86C430.854 94.86 429.274 96.24 429.274 97.92C429.274 102 435.754 100.58 435.754 103.02C435.754 103.92 434.954 104.64 433.514 104.64C431.974 104.64 431.034 103.84 430.934 102.78H429.054C429.174 104.78 430.974 106.18 433.534 106.18C435.954 106.18 437.534 104.82 437.534 103.02Z" fill="#0275d8"  />
                </svg>

    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
      aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="basicExampleNav">
        @if (Route::has('login'))
            <ul class="navbar-nav ml-auto">
                @auth
                    <li class="nav-item">
                        @if(Auth::user()->role === 1)
                        <a class="nav-link text-center btn btn-outline-primary "   href="{{route('admin')}}" >Home</a>
                        @else
                        <a class="nav-link text-center btn btn-outline-primary "   href="{{route('clients.index')}}" >Home</a>
                        @endif
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link text-center btn btn-outline-primary"  href="{{ route('login') }}">Connexion</a>
                    </li>
                    {{-- <li class="nav-item">
                        @if (Route::has('register'))
                            <a class="nav-link text-center btn btn-outline-primary"  href="{{ route('register') }}">Inscription</a>
                        @endif
                    </li> --}}
                @endauth
            </ul>
        @endif
    </div>
</nav>
<div id="big">
<h1>Votre emplacement idéal pour gérer vos factures</h1>
<h5>Gérez votre fichier client, établissez des devis et générez des factures facilement</h5>
<div class="d-flex justify-content-center mt-5">
    <svg   width="300" height="100" viewBox="0 0 438 107" fill="none">
        <path d="M0.957397 15.3192C0.957397 6.85862 7.81602 0 16.2765 0H74.6808C83.1413 0 90 6.85862 90 15.3192C90 23.7797 83.1414 30.6383 74.6808 30.6383H16.2766C7.81603 30.6383 0.957397 23.7797 0.957397 15.3192Z" fill="#2262C6"/>
        <path d="M30.6383 15.3192C30.6383 6.85862 37.4969 0 45.9575 0H74.6809C83.1414 0 90 6.85862 90 15.3192C90 23.7797 83.1414 30.6383 74.6809 30.6383H45.9575C37.4969 30.6383 30.6383 23.7797 30.6383 15.3192Z" fill="#427FDE"/>
        <path d="M50.7446 15.3192C50.7446 6.85862 57.6033 0 66.0638 0H74.6808C83.1413 0 90 6.85862 90 15.3192C90 23.7797 83.1413 30.6383 74.6808 30.6383H66.0638C57.6032 30.6383 50.7446 23.7797 50.7446 15.3192Z" fill="#FFC5A0"/>
        <path d="M15.3192 104.277C6.85862 104.277 0 97.418 0 88.9575V65.9787C0 57.5182 6.85862 50.6596 15.3192 50.6596C23.7797 50.6596 30.6383 57.5182 30.6383 65.9787V88.9575C30.6383 97.418 23.7797 104.277 15.3192 104.277Z" fill="#FFC5A0"/>
        <path d="M15.3192 88.9575C6.85862 88.9575 0 82.0989 0 73.6384V50.6596C0 42.1991 6.85862 35.3405 15.3192 35.3405C23.7797 35.3405 30.6383 42.1991 30.6383 50.6596V73.6384C30.6383 82.0989 23.7797 88.9575 15.3192 88.9575Z" fill="#2262C6"/>
        <path d="M0 50.6596C0 42.1991 6.85862 35.3405 15.3192 35.3405H44.0426C52.5031 35.3405 59.3617 42.1991 59.3617 50.6596C59.3617 59.1201 52.5031 65.9788 44.0426 65.9788H15.3192C6.85862 65.9788 0 59.1201 0 50.6596Z" fill="#427FDE"/>
        <path d="M87.6601 78H95.3551V59.28H99.4951V52.89H95.3551V52.665C95.3551 50.01 96.3901 49.11 99.3601 49.29V42.765C91.7101 42.36 87.6601 45.6 87.6601 52.17V52.89H84.8701V59.28H87.6601V78ZM102.931 65.4C102.931 73.32 107.836 78.36 113.956 78.36C117.691 78.36 120.346 76.65 121.741 74.445V78H129.436V52.89H121.741V56.445C120.391 54.24 117.736 52.53 114.001 52.53C107.836 52.53 102.931 57.48 102.931 65.4ZM121.741 65.445C121.741 69.45 119.176 71.655 116.251 71.655C113.371 71.655 110.761 69.405 110.761 65.4C110.761 61.395 113.371 59.235 116.251 59.235C119.176 59.235 121.741 61.44 121.741 65.445ZM137.568 69.27C137.568 75.795 141.213 78 146.433 78H150.348V71.475H147.603C145.893 71.475 145.263 70.845 145.263 69.36V59.28H150.303V52.89H145.263V46.77H137.568V52.89H134.508V59.28H137.568V69.27ZM180.554 65.445C180.554 57.48 174.884 52.53 167.504 52.53C160.169 52.53 154.454 57.48 154.454 65.445C154.454 73.41 160.034 78.36 167.414 78.36C174.794 78.36 180.554 73.41 180.554 65.445ZM162.284 65.445C162.284 61.17 164.714 59.19 167.504 59.19C170.204 59.19 172.724 61.17 172.724 65.445C172.724 69.675 170.159 71.7 167.414 71.7C164.624 71.7 162.284 69.675 162.284 65.445ZM210.781 52.89H203.086V66.525C203.086 69.945 201.196 71.835 198.226 71.835C195.346 71.835 193.411 69.945 193.411 66.525V52.89H185.761V67.56C185.761 74.265 189.676 78.27 195.481 78.27C198.856 78.27 201.556 76.74 203.086 74.58V78H210.781V52.89ZM225.354 66.345C225.354 62.025 227.469 60.765 231.114 60.765H233.229V52.62C229.854 52.62 227.109 54.42 225.354 57.075V52.89H217.659V78H225.354V66.345ZM236.727 65.4C236.727 73.32 241.632 78.36 247.752 78.36C251.487 78.36 254.142 76.65 255.537 74.445V78H263.232V52.89H255.537V56.445C254.187 54.24 251.532 52.53 247.797 52.53C241.632 52.53 236.727 57.48 236.727 65.4ZM255.537 65.445C255.537 69.45 252.972 71.655 250.047 71.655C247.167 71.655 244.557 69.405 244.557 65.4C244.557 61.395 247.167 59.235 250.047 59.235C252.972 59.235 255.537 61.44 255.537 65.445Z" fill="#2262C6"/>
        <path id="text" d="M88.6767 95.04L92.9767 106H95.0967L99.3967 95.04H97.4567L94.0567 104.32L90.6367 95.04H88.6767ZM112.188 100.5C112.188 97.04 109.768 94.86 106.648 94.86C103.548 94.86 101.108 97.04 101.108 100.5C101.108 103.98 103.468 106.18 106.568 106.18C109.688 106.18 112.188 103.98 112.188 100.5ZM102.968 100.5C102.968 97.74 104.708 96.44 106.628 96.44C108.508 96.44 110.328 97.74 110.328 100.5C110.328 103.28 108.468 104.58 106.568 104.58C104.668 104.58 102.968 103.28 102.968 100.5ZM115.581 103C115.581 105.2 116.681 106 118.621 106H120.261V104.46H118.921C117.801 104.46 117.401 104.08 117.401 103V96.54H120.261V95.04H117.401V92.28H115.581V95.04H114.161V96.54H115.581V103ZM124.886 100.04C124.886 97.5 126.206 96.72 127.946 96.72H128.426V94.84C126.686 94.84 125.506 95.6 124.886 96.82V95.04H123.066V106H124.886V100.04ZM135.787 96.4C137.667 96.4 139.267 97.58 139.247 99.72H132.327C132.527 97.58 134.007 96.4 135.787 96.4ZM140.907 102.62H138.947C138.547 103.8 137.507 104.64 135.867 104.64C134.007 104.64 132.447 103.42 132.307 101.2H141.067C141.107 100.82 141.127 100.5 141.127 100.1C141.127 97.1 139.047 94.86 135.867 94.86C132.667 94.86 130.447 97.04 130.447 100.5C130.447 103.98 132.747 106.18 135.867 106.18C138.587 106.18 140.347 104.62 140.907 102.62ZM160.461 100.5C160.461 97.04 158.041 94.86 154.921 94.86C151.821 94.86 149.381 97.04 149.381 100.5C149.381 103.98 151.741 106.18 154.841 106.18C157.961 106.18 160.461 103.98 160.461 100.5ZM151.241 100.5C151.241 97.74 152.981 96.44 154.901 96.44C156.781 96.44 158.601 97.74 158.601 100.5C158.601 103.28 156.741 104.58 154.841 104.58C152.941 104.58 151.241 103.28 151.241 100.5ZM173.174 95.04H171.354V101.06C171.354 103.42 170.094 104.58 168.214 104.58C166.374 104.58 165.154 103.44 165.154 101.22V95.04H163.354V101.46C163.354 104.6 165.334 106.16 167.854 106.16C169.314 106.16 170.654 105.52 171.354 104.38V106H173.174V95.04ZM177.247 103C177.247 105.2 178.347 106 180.287 106H181.927V104.46H180.587C179.467 104.46 179.067 104.08 179.067 103V96.54H181.927V95.04H179.067V92.28H177.247V95.04H175.827V96.54H177.247V103ZM184.732 106H186.552V95.04H184.732V106ZM185.672 93.26C186.332 93.26 186.872 92.72 186.872 92.02C186.872 91.32 186.332 90.78 185.672 90.78C184.972 90.78 184.432 91.32 184.432 92.02C184.432 92.72 184.972 93.26 185.672 93.26ZM190.254 106H192.074V91.2H190.254V106ZM201.028 100.48C201.028 103.88 203.288 106.18 206.228 106.18C208.228 106.18 209.648 105.16 210.308 103.94V106H212.148V91.2H210.308V97C209.548 95.74 207.968 94.86 206.248 94.86C203.288 94.86 201.028 97.06 201.028 100.48ZM210.308 100.5C210.308 103.08 208.588 104.58 206.588 104.58C204.588 104.58 202.888 103.06 202.888 100.48C202.888 97.9 204.588 96.44 206.588 96.44C208.588 96.44 210.308 97.96 210.308 100.5ZM220.484 96.4C222.364 96.4 223.964 97.58 223.944 99.72H217.024C217.224 97.58 218.704 96.4 220.484 96.4ZM225.604 102.62H223.644C223.244 103.8 222.204 104.64 220.564 104.64C218.704 104.64 217.144 103.42 217.004 101.2H225.764C225.804 100.82 225.824 100.5 225.824 100.1C225.824 97.1 223.744 94.86 220.564 94.86C217.364 94.86 215.144 97.04 215.144 100.5C215.144 103.98 217.444 106.18 220.564 106.18C223.284 106.18 225.044 104.62 225.604 102.62ZM235.098 106H236.918V96.54H239.218V95.04H236.918V94.26C236.918 92.84 237.458 92.24 239.098 92.24V90.72C236.298 90.72 235.098 91.82 235.098 94.26V95.04H233.678V96.54H235.098V106ZM241.26 100.48C241.26 103.88 243.52 106.18 246.44 106.18C248.46 106.18 249.88 105.14 250.54 103.96V106H252.38V95.04H250.54V97.04C249.9 95.9 248.5 94.86 246.46 94.86C243.52 94.86 241.26 97.06 241.26 100.48ZM250.54 100.5C250.54 103.08 248.82 104.58 246.82 104.58C244.82 104.58 243.12 103.06 243.12 100.48C243.12 97.9 244.82 96.44 246.82 96.44C248.82 96.44 250.54 97.96 250.54 100.5ZM255.376 100.5C255.376 103.98 257.596 106.18 260.716 106.18C263.436 106.18 265.216 104.66 265.776 102.48H263.816C263.416 103.86 262.336 104.64 260.716 104.64C258.716 104.64 257.236 103.22 257.236 100.5C257.236 97.82 258.716 96.4 260.716 96.4C262.336 96.4 263.436 97.24 263.816 98.56H265.776C265.216 96.26 263.436 94.86 260.716 94.86C257.596 94.86 255.376 97.06 255.376 100.5ZM269.204 103C269.204 105.2 270.304 106 272.244 106H273.884V104.46H272.544C271.424 104.46 271.024 104.08 271.024 103V96.54H273.884V95.04H271.024V92.28H269.204V95.04H267.784V96.54H269.204V103ZM286.409 95.04H284.589V101.06C284.589 103.42 283.329 104.58 281.449 104.58C279.609 104.58 278.389 103.44 278.389 101.22V95.04H276.589V101.46C276.589 104.6 278.569 106.16 281.089 106.16C282.549 106.16 283.889 105.52 284.589 104.38V106H286.409V95.04ZM291.902 100.04C291.902 97.5 293.222 96.72 294.962 96.72H295.442V94.84C293.702 94.84 292.522 95.6 291.902 96.82V95.04H290.082V106H291.902V100.04ZM297.463 100.48C297.463 103.88 299.723 106.18 302.643 106.18C304.663 106.18 306.083 105.14 306.743 103.96V106H308.583V95.04H306.743V97.04C306.103 95.9 304.703 94.86 302.663 94.86C299.723 94.86 297.463 97.06 297.463 100.48ZM306.743 100.5C306.743 103.08 305.023 104.58 303.023 104.58C301.023 104.58 299.323 103.06 299.323 100.48C299.323 97.9 301.023 96.44 303.023 96.44C305.023 96.44 306.743 97.96 306.743 100.5ZM312.659 103C312.659 105.2 313.759 106 315.699 106H317.339V104.46H315.999C314.879 104.46 314.479 104.08 314.479 103V96.54H317.339V95.04H314.479V92.28H312.659V95.04H311.239V96.54H312.659V103ZM320.144 106H321.964V95.04H320.144V106ZM321.084 93.26C321.744 93.26 322.284 92.72 322.284 92.02C322.284 91.32 321.744 90.78 321.084 90.78C320.384 90.78 319.844 91.32 319.844 92.02C319.844 92.72 320.384 93.26 321.084 93.26ZM336.066 100.5C336.066 97.04 333.646 94.86 330.526 94.86C327.426 94.86 324.986 97.04 324.986 100.5C324.986 103.98 327.346 106.18 330.446 106.18C333.566 106.18 336.066 103.98 336.066 100.5ZM326.846 100.5C326.846 97.74 328.586 96.44 330.506 96.44C332.386 96.44 334.206 97.74 334.206 100.5C334.206 103.28 332.346 104.58 330.446 104.58C328.546 104.58 326.846 103.28 326.846 100.5ZM347.079 106H348.879V99.54C348.879 96.4 346.939 94.84 344.399 94.84C342.919 94.84 341.599 95.46 340.879 96.6V95.04H339.059V106H340.879V99.94C340.879 97.58 342.159 96.42 344.019 96.42C345.859 96.42 347.079 97.56 347.079 99.8V106ZM363.044 96.4C364.924 96.4 366.524 97.58 366.504 99.72H359.584C359.784 97.58 361.264 96.4 363.044 96.4ZM368.164 102.62H366.204C365.804 103.8 364.764 104.64 363.124 104.64C361.264 104.64 359.704 103.42 359.564 101.2H368.324C368.364 100.82 368.384 100.5 368.384 100.1C368.384 97.1 366.304 94.86 363.124 94.86C359.924 94.86 357.704 97.04 357.704 100.5C357.704 103.98 360.004 106.18 363.124 106.18C365.844 106.18 367.604 104.62 368.164 102.62ZM371.786 103C371.786 105.2 372.886 106 374.826 106H376.466V104.46H375.126C374.006 104.46 373.606 104.08 373.606 103V96.54H376.466V95.04H373.606V92.28H371.786V95.04H370.366V96.54H371.786V103ZM384.523 100.48C384.523 103.88 386.783 106.18 389.723 106.18C391.723 106.18 393.143 105.16 393.803 103.94V106H395.643V91.2H393.803V97C393.043 95.74 391.463 94.86 389.743 94.86C386.783 94.86 384.523 97.06 384.523 100.48ZM393.803 100.5C393.803 103.08 392.083 104.58 390.083 104.58C388.083 104.58 386.383 103.06 386.383 100.48C386.383 97.9 388.083 96.44 390.083 96.44C392.083 96.44 393.803 97.96 393.803 100.5ZM403.979 96.4C405.859 96.4 407.459 97.58 407.439 99.72H400.519C400.719 97.58 402.199 96.4 403.979 96.4ZM409.099 102.62H407.139C406.739 103.8 405.699 104.64 404.059 104.64C402.199 104.64 400.639 103.42 400.499 101.2H409.259C409.299 100.82 409.319 100.5 409.319 100.1C409.319 97.1 407.239 94.86 404.059 94.86C400.859 94.86 398.639 97.04 398.639 100.5C398.639 103.98 400.939 106.18 404.059 106.18C406.779 106.18 408.539 104.62 409.099 102.62ZM411.021 95.04L415.321 106H417.441L421.741 95.04H419.801L416.401 104.32L412.981 95.04H411.021ZM424.132 106H425.952V95.04H424.132V106ZM425.072 93.26C425.732 93.26 426.272 92.72 426.272 92.02C426.272 91.32 425.732 90.78 425.072 90.78C424.372 90.78 423.832 91.32 423.832 92.02C423.832 92.72 424.372 93.26 425.072 93.26ZM437.534 103.02C437.454 99.1 431.094 100.52 431.094 97.92C431.094 97.04 431.894 96.4 433.234 96.4C434.694 96.4 435.534 97.2 435.614 98.3H437.434C437.314 96.16 435.714 94.86 433.294 94.86C430.854 94.86 429.274 96.24 429.274 97.92C429.274 102 435.754 100.58 435.754 103.02C435.754 103.92 434.954 104.64 433.514 104.64C431.974 104.64 431.034 103.84 430.934 102.78H429.054C429.174 104.78 430.974 106.18 433.534 106.18C435.954 106.18 437.534 104.82 437.534 103.02Z" fill="#0275d8"  />
        </svg>
</div>
<p class="text-center">Compatible Mobile, Tablettes & P.C</p>
<p class="text-center">Vous pouvez gérer vos factures gratuitement sur tous vos appareils</p>
</div>
<div class="images row container-fluid">
<div class="col-12 col-lg-4"><img src="{{asset('img/pc.png')}}" alt="pc" class="img-responsive image"></div>
<div class=" col-12 col-lg-4"><img src="{{asset('img/tablet.png')}}" alt="tablet" class="img-responsive image"></div>
<div class=" col-12 col-lg-4"><img src="{{asset('img/phone.png')}}" alt="phone" class="img-responsive image"></div>
</div>
<div id="stat" class=" my-5">
<h2 class="text-center mt-5 mx-2">Des millions des personnes utilisent quotidiennement notre outil</h2>
<div class="container row  mx-auto mt-5">
    <div class=" col-12 col-md-5 col-lg-3 d-flex justify-content-center"><img src="{{asset('img/facture.png')}}" alt="facturation" class="img-responsive image"></div>
    <div class=" col-12 col-md-5 col-lg-3 d-flex justify-content-center"><img src="{{asset('img/visteurs.png')}}" alt="visiteurs" class="img-responsive image"></div>
    <div class=" col-12 col-md-5 col-lg-3 d-flex justify-content-center"><img src="{{asset('img/Devis.png')}}" alt="devis" class="img-responsive image"></div>
    <div class=" col-12 col-md-5 col-lg-3 d-flex justify-content-center"><img src="{{asset('img/opportunité.png')}}" alt="oportunité" class="img-responsive image"></div>
</div>
</div>
<div id="articles">
<div class="container row d-flex justify-content-between mx-auto my-5">
    <div class="article col-12 col-md-5 col-lg-3 mt-3">
        <div class="row">
            <ul>
                <li><a href="#"><i class="fas fa-file-alt"></i></a></li>
            </ul>
            <p class="col-12">CREATION DE DEVIS ET DE FACTURES</p>
            <span class="ml-3"></span>
            <span class="ml-3"></span>
            <span class="ml-3"></span>
            <p class="col-12">Générez devis et factures gratuitement. Dupliquez les documents ou transformez-les.
             Exportez-les sous différents formats. Chaque document est rattaché à un client.
              Obtenez facilement une vision d'ensemble !</p>
            <a href="#" class="btn voirplus">Voir plus<span class="fas fa-arrow-right"></span></a>
        </div>
    </div>
    <div class="article col-12 col-md-5 col-lg-3 mt-3">
        <div class="row">
            <ul>
                <li><a href="#"><i class="far fa-gem"></i></a></li>
            </ul>
            <p class="col-12">Opportunités d'affaires</p>
            <span class="ml-3"></span>
            <span class="ml-3"></span>
            <span class="ml-3"></span>
            <p class="col-12">Les opportunités d'affaire permettent une visibilité claire de votre prévisionnel de chiffre d'affaires. C'est une fonction CRM puissante.
                 Rentrez juste pour chaque client les projets que vous pensez pouvoir signer puis précisez simplement le montant du projet.</p>
            <a href="#" class="btn voirplus">Voir plus<span class="fas fa-arrow-right"></span></a>
        </div>
    </div>
    <div class="article col-12 col-md-5 col-lg-3 mt-3">
        <div class="row">
            <ul>
                <li><a href="#"><i class="fas fa-tasks"></i></a></li>
            </ul>
            <p class="col-12">GESTION DES CLIENTS</p>
            <span class="ml-3"></span>
            <span class="ml-3"></span>
            <span class="ml-3"></span>
            <p class="col-12">Un véritable CRM au sein de votre outil de facturation gratuit. Ajoutez, supprimez et modifiez vos clients. Ajoutez des informations,
                 rentrez votre activité au fur et à mesure (appels, rendez-vous, emails) et ajoutez des devis, des factures, des avoirs et même des opportunités d'affaire.</p>
            <a href="#" class="btn voirplus">Voir plus<span class="fas fa-arrow-right"></span></a>
        </div>
    </div>

</div>
<div class="container row d-flex justify-content-between mx-auto my-5">
    <div class="article col-12 col-md-5 col-lg-3 mt-3">
        <div class="row">
            <ul>
                <li><a href="#"><i class="fas fa-search"></i></a></li>
            </ul>
            <p class="col-12">Moteur de recherche puissant</p>
            <span class="ml-3"></span>
            <span class="ml-3"></span>
            <span class="ml-3"></span>
            <p class="col-12">Trouvez facilement vos documents. Notre moteur de recherche vous permet de filtrer,
                 de trouver et de sélectionner clients, devis et factures en quelques instants.</p>
            <a href="#" class="btn voirplus">Voir plus<span class="fas fa-arrow-right"></span></a>
        </div>
    </div>
    <div class="article col-12 col-md-5 col-lg-3 mt-3">
        <div class="row">
            <ul>
                <li><a href="#"><i class="fas fa-download"></i></a></li>
            </ul>
            <p class="col-12">Exporter tout en un clic</p>
            <span class="ml-3"></span>
            <span class="ml-3"></span>
            <span class="ml-3"></span>
            <p class="col-12">Vous pouvez exporter vos factures et vos devis en un seul clic.
                 Fonctionnement idéal pour transmettre ses documents à un comptable ou à un client.</p>
            <a href="#" class="btn voirplus">Voir plus<span class="fas fa-arrow-right"></span></a>
        </div>
    </div>
    <div class="article col-12 col-md-5 col-lg-3 mt-3">
        <div class="row">
            <ul>
                <li><a href="#"><i class="fas fa-sort-amount-up-alt"></i></a></li>
            </ul>
            <p class="col-12">Classement par catégories</p>
            <span class="ml-3"></span>
            <span class="ml-3"></span>
            <span class="ml-3"></span>
            <p class="col-12">Que ce soit pour améliorer le fonctionnement de votre CRM gratuit ou pour mieux classer votre comptabilité,
                 le classement par catégorie permet de rassembler les devis, factures et clients selon une thématique ou une classe particulière.</p>
            <a href="#" class="btn voirplus">Voir plus<span class="fas fa-arrow-right"></span></a>
        </div>
    </div>
</div>
</div>
<!-- Footer -->
<footer class="page-footer font-small indigo">
    <!-- Footer Links -->
    <div class="container">
      <div class="row text-center d-flex justify-content-center pt-5 mb-3">
        <div class="col-md-2 mb-3">
          <h6 class="text-uppercase font-weight-bold">
            <a href="#!">Qui Nous</a>
          </h6>
        </div>
        <div class="col-md-2 mb-3">
          <h6 class="text-uppercase font-weight-bold">
            <a href="#!">Notre Siteweb</a>
          </h6>
        </div>
        <div class="col-md-2 mb-3">
          <h6 class="text-uppercase font-weight-bold">
            <a href="#!">Blog</a>
          </h6>
        </div>
        <div class="col-md-2 mb-3">
          <h6 class="text-uppercase font-weight-bold">
            <a href="#!">Aide</a>
          </h6>
        </div>
        <div class="col-md-2 mb-3">
          <h6 class="text-uppercase font-weight-bold">
            <a href="#!">Contact</a>
          </h6>
        </div>
      </div>
      <!-- Grid row-->
      <hr class="rgba-white-light" style="margin: 0 15%;">

      <!-- Grid row-->
      <div class="row d-flex text-center justify-content-center mb-md-0 mb-4">
        <!-- Grid column -->
        <div class="col-md-8 col-12 mt-5 desc">
          <p style="line-height: 1.7rem">Il est toujours plus facile de faire du bon travail lorsque l'on croit en ce que l'on fait.
             C'est la raison pour laquelle nous m'engageons à d'aider davantage des personnes, jour après jour.</p>
        </div>
        <!-- Grid column -->
      </div>
      <!-- Grid row-->
      <hr class="clearfix d-md-none rgba-white-light" style="margin: 10% 15% 5%;">
      <div class="row pb-3 mt-2">
        <div class="col-md-12 icons">
          <div class="mb-5 text-center">
            <!-- Facebook -->
            <a class="fb-ic">
              <i class="fab fa-facebook-f fa-lg white-text mr-4"> </i>
            </a>
            <!-- Twitter -->
            <a class="tw-ic">
              <i class="fab fa-twitter fa-lg white-text mr-4"> </i>
            </a>
            <!-- Google +-->
            <a class="gplus-ic">
              <i class="fab fa-google-plus-g fa-lg white-text mr-4"> </i>
            </a>
            <!--Instagram-->
            <a class="ins-ic">
              <i class="fab fa-instagram fa-lg white-text mr-4"> </i>
            </a>
          </div>
        </div>
      </div>
    </div>
    <!-- Copyright -->
    <div class="footer-copyright text-center py-3" style="color: white">© 2021 Copyright:
      <a href="https://devosoft.ma">Devosoft.ma</a>
    </div>
    <!-- Copyright -->
  </footer>
  <!-- Footer -->
@endsection


