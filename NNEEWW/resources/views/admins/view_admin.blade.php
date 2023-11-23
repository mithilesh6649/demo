@extends('adminlte::page')

@section('title', 'Admin Information')

@section('content_header')
@stop

@section('content')
    <div class="container-fluid p-0">
            <div class="col-md-12">
                <div class="card order_outer rounded_circle">
                    <div class="card-body rounded_circle table p-0 mb-0">
                        <div class="order_details">
                            <div class="card-main pt-3">
                                <div class="order_heading alert d-flex align-items-center justify-content-between mb-4">
                                    <h3 class="mb-0">{{ __('adminlte::adminlte.admin_information') }}</h3>
                                    <a class="btn btn-sm btn-success add-advance-options"
                                        href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
                                </div>
                                <div class="card-body main_body form p-3">
                                    @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                    @endif

                                    <form class="form_wrap" style="pointer-events: none;">
                                        
                                        <div class="row">

                                                 <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12">
                                       <div class="profile-image-show mt-3">
                                           <a href="javascript:;"
                                           class="remove-pro-img d-none {{ @$viewAdmin[0]->image != null ? '' : 'd-none' }}"
                                           id="{{ @$viewAdmin[0]->id ?? '' }}"
                                           style="display:block">
                                           <svg width="25" height="25" viewBox="0 0 257 256"
                                           fill="none" xmlns="http://www.w3.org/2000/svg">
                                           <g clip-path="url(#clip0_2088_553)">
                                               <path
                                               d="M254.85 141.81C253.9 157.47 249.21 172.11 241.97 185.85C222.7 222.45 192.59 244.9 152.18 253.57C150.9 253.85 149.55 253.82 148.23 253.94C127.66 257.72 107.47 255.81 87.7603 249.26C32.6403 230.94 -2.94973 178.37 0.190275 120.27C3.53027 58.4501 52.5803 6.9701 114.11 0.700098C183.3 -6.3499 244.07 40.6301 254.6 109.51C256.23 120.2 256.83 131.03 254.85 141.81V141.81Z"
                                               fill="#F7F9FA" />
                                               <path
                                               d="M254.85 141.81C251.98 142.27 250.79 139.87 249.24 138.32C230 119.18 210.83 99.9701 191.64 80.7801C190.08 79.2301 188.55 77.6401 186.86 76.2301C186.73 76.1101 186.6 76.0101 186.47 75.9101C186.37 75.8201 186.27 75.7401 186.17 75.6601C179.43 68.4101 174.9 68.2601 167.78 75.3201C156.31 86.6701 144.95 98.1401 133.52 109.53C128.75 114.28 128.21 114.29 123.52 109.63C111.61 97.7701 99.7803 85.8401 87.8503 74.0101C83.5703 69.7701 79.6603 69.0701 75.8503 71.6001C70.9103 74.8801 70.1903 80.2701 74.3803 84.8201C79.1203 89.9501 84.2103 94.7501 89.1403 99.7001C96.6603 107.24 104.24 114.72 111.71 122.31C115.58 126.24 115.59 127.4 111.66 131.37C100.3 142.84 88.8503 154.21 77.4403 165.63C76.0403 167.04 74.5503 168.4 73.4803 170.11C70.4303 174.98 71.1603 179.23 75.6803 182.84C76.5803 183.56 77.6903 184.03 78.3503 185.05C78.4203 185.21 78.4903 185.36 78.5803 185.51C78.5903 185.55 78.6103 185.59 78.6403 185.63C79.4203 187.06 80.6103 188.16 81.7603 189.31C101.43 208.97 121.13 228.61 140.72 248.36C142.99 250.65 145.76 252.04 148.23 253.94C127.66 257.72 107.47 255.81 87.7603 249.26C32.6403 230.94 -2.94973 178.37 0.190275 120.27C3.53027 58.4501 52.5803 6.9701 114.11 0.700098C183.3 -6.3499 244.07 40.6301 254.6 109.51C256.23 120.2 256.83 131.03 254.85 141.81V141.81Z"
                                               fill="#E11B1B" />
                                               <path
                                               d="M254.851 141.81C253.901 157.47 249.211 172.11 241.971 185.85C222.701 222.45 192.591 244.9 152.181 253.57C150.901 253.85 149.551 253.82 148.231 253.94C145.631 253.93 143.601 252.98 141.691 251.05C121.101 230.32 100.401 209.7 79.8109 188.98C79.0309 188.19 76.6309 187.69 78.2509 185.61C78.3609 185.58 78.471 185.55 78.581 185.51C85.011 183.79 89.421 179.22 93.911 174.65C103.951 164.44 114.101 154.34 124.281 144.26C128.391 140.18 129.551 140.18 133.721 144.32C144.961 155.46 156.111 166.68 167.301 177.86C168.361 178.92 169.391 180.01 170.501 181.02C174.681 184.83 179.601 185.14 183.031 181.84C186.531 178.46 186.521 172.88 182.621 168.86C172.881 158.82 162.871 149.04 153.001 139.13C151.001 137.13 148.991 135.13 146.991 133.12C141.341 127.44 141.331 127.19 146.851 121.66C156.381 112.11 165.821 102.47 175.501 93.0802C180.591 88.1502 185.511 83.2702 186.471 75.9102C186.521 75.5802 186.551 75.2502 186.581 74.9102C188.681 75.4402 189.791 77.2202 191.171 78.6002C211.061 98.4402 230.911 118.32 250.781 138.17C252.071 139.45 253.491 140.6 254.851 141.81V141.81Z"
                                               fill="#C30606" />
                                               <path
                                               d="M186.59 74.9098C187.91 79.9298 186.29 83.8598 182.62 87.4598C170.4 99.4598 158.43 111.72 146.19 123.7C143.59 126.25 143.08 127.63 146.03 130.49C158.57 142.64 170.82 155.09 183.14 167.46C187.36 171.69 188.23 176.25 185.8 180.48C182.3 186.59 174.86 187.29 169.34 181.82C156.93 169.53 144.51 157.25 132.36 144.72C129.44 141.71 127.98 141.78 125.1 144.75C113.17 157.04 100.91 169.01 88.8705 181.2C85.8805 184.23 82.5405 185.95 78.2505 185.62C68.6605 181.06 67.5405 174.17 75.2105 166.49C87.3205 154.35 99.3805 142.15 111.65 130.17C114.22 127.66 114 126.36 111.57 123.97C98.8505 111.49 86.3205 98.8298 73.7205 86.2298C70.1505 82.6498 69.0905 78.4998 71.5605 73.9798C73.7705 69.9098 77.4505 68.2598 82.0605 68.8998C84.8505 69.2898 86.8105 71.0798 88.7205 72.9998C100.71 85.0298 112.83 96.9298 124.67 109.11C127.65 112.18 129.28 112.74 132.58 109.3C144.34 97.0498 156.48 85.1698 168.52 73.1898C175.19 66.5498 181.31 67.1798 186.6 74.9198L186.59 74.9098Z"
                                               fill="#FEFEFE" />
                                           </g>
                                           <defs>
                                               <clipPath id="clip0_2088_553">
                                                   <rect width="256.1" height="255.86" fill="white" />
                                               </clipPath>
                                           </defs>
                                       </svg>
                                   </a>

                                   <img src="{{ @$viewAdmin[0]->image }}"
                                   class="{{ @$viewAdmin[0]->image != null ? '' : 'd-none' }}"
                                   width="80%" id="profileImage">

                                   <div
                                   class="thumb_nails {{ @$viewAdmin[0]->image != null ? 'd-none' : '' }}">
                                                <!--      <svg width="60" height="55" viewBox="0 0 512 470"
                                                         fill="none" xmlns="http://www.w3.org/2000/svg">
                                                         <g clip-path="url(#clip0_0_1)">
                                                             <path
                                                                 d="M511.79 41.6V301.5C508.66 323.5 495.31 336.01 474.67 341.87C471.945 342.618 469.124 342.955 466.3 342.87C455.087 342.91 443.877 342.94 432.67 342.96H430.99C332.7 343.17 234.42 342.88 136.14 343.18C112.45 343.26 96.78 331.7 86.39 311.79C82.56 304.45 83.61 295.79 83.5 287.72C83.15 262.09 83.34 236.44 83.38 210.8C83.44 169.92 83.21 129.05 83.48 88.17V87.02C83.48 86.66 83.48 86.3 83.48 85.94C83.8 70.94 82.48 55.94 84.4 41.06C87.16 20.14 106.07 -0.0499823 131.14 0.0600177C243 0.300018 354.86 0.140013 466.71 0.180013C477.698 0.166221 488.307 4.19563 496.516 11.5004C504.724 18.8052 509.958 28.8747 511.22 39.79C511.22 40.11 511.3 40.43 511.33 40.79C511.43 41.0868 511.587 41.3618 511.79 41.6Z"
                                                                 fill="black" />
                                                             <path
                                                                 d="M511.79 301.47C508.66 323.47 495.31 335.98 474.67 341.84C471.945 342.588 469.124 342.925 466.3 342.84C455.087 342.88 443.877 342.91 432.67 342.93C432.245 343.155 431.877 343.475 431.596 343.865C431.315 344.255 431.128 344.705 431.05 345.18C429.05 353.18 426.95 361.18 424.9 369.18C434.13 373.86 437.17 380.02 434.78 389.91C431.3 404.27 427.83 418.63 424.04 432.91C416.78 460.28 391.26 475 363.9 467.68C265.9 441.493 167.933 415.28 70 389.04C59.42 386.26 48.89 383.35 38.26 380.6C17.86 375.22 5.26 362.4 0.82 341.6C0.74 341.18 0.28 340.84 0 340.46C2.45 340.54 2.14 342.67 2.56 344.09C8 362.57 19.85 374.28 38.56 379.25C90.7133 393.09 142.823 407.03 194.89 421.07C250.84 436.07 306.89 450.87 362.74 466.14C389.74 473.52 414.31 460.46 422.4 433.66C427.01 418.36 430.4 402.72 433.9 387.12C435.17 381.4 432.79 376.71 428.47 372.95C427.03 371.69 425.11 370.95 424.2 369.09L424.12 368.93C424.115 368.867 424.115 368.803 424.12 368.74C424.49 360.24 427.7 352.42 430.12 344.42C430.27 343.862 430.567 343.355 430.98 342.95C431.98 342.01 433.45 341.95 434.98 341.95C444.28 342.01 453.58 341.95 462.89 341.95C464.53 341.95 466.21 342.26 467.81 341.61C489.49 339.2 505.46 325.19 510.69 304.02C510.94 303.12 510.6 301.98 511.79 301.47Z"
                                                                 fill="#FEFEFE" />
                                                             <path
                                                                 d="M434.78 389.96C431.3 404.32 427.83 418.68 424.04 432.96C416.78 460.33 391.26 475.05 363.9 467.73C265.9 441.543 167.933 415.33 70 389.09C59.42 386.26 48.89 383.35 38.26 380.6C17.86 375.22 5.26 362.4 0.82 341.6C0.74 341.18 0.28 340.84 0 340.46V330.46C0.92 328.97 0.440001 327.36 0.470001 325.78C0.465012 325.693 0.465012 325.607 0.470001 325.52C0.470001 325.37 0.470001 325.22 0.470001 325.08C0.668369 320.089 1.48116 315.142 2.89 310.35C12.96 272.08 23.06 233.8 32.83 195.44C33.77 191.74 34.83 188.06 35.83 184.38C39.21 172.64 44.69 168.74 56.95 169.28L57.17 169.35L57.71 169.52C67.65 172.83 72.19 180.81 69.71 191.74C67.71 200.66 65.2 209.49 62.87 218.35C53.37 254.583 43.9067 290.83 34.48 327.09C33.1 332.38 33.2 337.22 36.39 341.87C38.81 345.41 42.26 347.06 46.24 348.13C72.6 355.237 98.9733 362.31 125.36 369.35C194.17 387.85 263.05 406.11 331.83 424.71C345.01 428.27 358.22 431.71 371.41 435.26C382.17 438.14 389.24 434.1 392.15 423.16C395.483 410.613 398.617 398.01 401.55 385.35C402.83 379.76 404.55 374.41 409.37 370.69C414.19 366.97 419.93 366.21 424.14 368.69C424.401 368.84 424.655 369.004 424.9 369.18C434.13 373.91 437.17 380.07 434.78 389.96Z"
                                                                 fill="black" />
                                                             <path
                                                                 d="M511.23 39.73C510.59 37.56 509.96 35.39 509.23 33.26C506.069 23.7113 499.966 15.4084 491.796 9.54142C483.626 3.67439 473.808 0.544395 463.75 0.600026C353.71 0.526693 243.67 0.526693 133.63 0.600026C106.19 0.600026 85.58 21.6 85.21 49.6C85.05 61.6 85.05 73.6 84.98 85.54C84.46 86.4 83.98 87.27 83.48 88.14C72.89 107.14 70.48 128.86 63.98 149.22C62.42 154.13 61.13 159.13 59.9 164.15C59.5986 166.075 58.8596 167.905 57.74 169.5C57.4925 169.801 57.218 170.079 56.92 170.33C45.06 169.85 39.92 173.69 36.99 185.19C25.2833 230.283 13.56 275.37 1.82 320.45C1.41 322.04 1.21 323.69 0.91 325.32C0.79 325.63 0.640001 325.78 0.470001 325.78C0.300001 325.78 0.18 325.68 0 325.47C0.153519 325.526 0.318317 325.543 0.48 325.52C0.48 325.37 0.48 325.22 0.48 325.08C0.675114 320.09 1.48455 315.142 2.89 310.35C12.96 272.08 23.06 233.8 32.83 195.44C33.77 191.74 34.83 188.06 35.83 184.38C39.21 172.64 44.69 168.74 56.95 169.28L57.17 169.35C63.59 146.02 69.95 122.68 76.5 99.35C77.7665 94.705 80.1725 90.4497 83.5 86.97C83.5 86.61 83.5 86.25 83.5 85.89C83.82 70.89 82.5 55.89 84.42 41.01C87.18 20.09 106.09 -0.09997 131.16 0.01003C243.02 0.25003 354.88 0.0900251 466.73 0.130025C477.715 0.118408 488.32 4.14752 496.526 11.45C504.732 18.7525 509.966 28.8182 511.23 39.73V39.73Z"
                                                                 fill="#FEFEFE" />
                                                             <path
                                                                 d="M0 330.46V325.46C0.153519 325.516 0.318317 325.533 0.48 325.51C0.637296 325.479 0.784777 325.41 0.91 325.31C1.19 327.14 1.56 328.97 0 330.46Z"
                                                                 fill="#353535" />
                                                             <path
                                                                 d="M117.19 264.53V52.24C117.19 38.29 122.94 32.58 136.92 32.58H460.78C473.71 32.58 479.78 38.58 479.78 51.4V217.72C466.68 202.46 454.36 188.11 442.05 173.72C429.05 158.55 415.62 143.72 403.14 128.11C385.85 106.51 357.27 111.11 343.14 128.62C318.62 158.9 293.33 188.56 268.5 218.62C266.14 221.47 264.95 221.89 262.24 219.01C255.4 211.72 248.24 204.75 241.11 197.73C224.22 181.09 202.05 181.15 185.28 197.88C164.033 219.027 142.82 240.237 121.64 261.51C120.561 262.76 119.587 264.098 118.73 265.51L117.19 264.53Z"
                                                                 fill="#EBEEF0" />
                                                             <path
                                                                 d="M467.83 341.6C464.36 343.32 460.65 342.38 457.06 342.46C449.92 342.62 442.77 342.56 435.62 342.46C434.599 342.373 433.573 342.524 432.62 342.9C432.195 343.125 431.827 343.445 431.546 343.835C431.265 344.225 431.078 344.675 431 345.15C429 353.15 426.9 361.15 424.85 369.15L424.16 369.01C413.82 367.01 406.35 371.66 403.78 381.93C400.38 395.47 397.027 409.023 393.72 422.59C390.59 435.32 383.17 439.76 370.38 436.33C277.76 411.53 185.143 386.71 92.53 361.87C76.9967 357.75 61.45 353.62 45.89 349.48C34.89 346.54 30.1 338.65 32.97 327.6C44.6433 282.56 56.3533 237.523 68.1 192.49C71.03 181.23 67.8 174.94 56.92 170.36C57.01 170.03 57.1 169.69 57.2 169.36C63.62 146.03 69.98 122.69 76.53 99.36C77.7964 94.715 80.2025 90.4596 83.53 86.98C84.01 86.48 84.53 85.98 85.03 85.53C85.13 87.35 85.31 89.17 85.31 90.99C85.31 155.29 85.31 219.59 85.31 283.89C85.31 291.04 85.42 298.22 85.99 305.34C86.65 313.47 92.35 319.18 97.16 324.93C107.03 336.75 120.16 341.7 135.56 341.67C209.013 341.563 282.457 341.54 355.89 341.6H467.83Z"
                                                                 fill="#D4D9DB" />
                                                             <path
                                                                 d="M278.8 256.43C300.26 230.543 321.72 204.673 343.18 178.82C351.26 169.08 359.353 159.357 367.46 149.65C371.98 144.25 374.57 144.16 379.05 149.38C411.777 187.553 444.503 225.72 477.23 263.88C478.123 264.834 478.815 265.958 479.267 267.184C479.719 268.41 479.92 269.715 479.86 271.02C479.68 278.51 479.86 286.02 479.77 293.5C479.62 302.9 473.12 309.63 463.71 309.65C420.423 309.75 377.133 309.75 333.84 309.65C333.501 309.619 333.165 309.552 332.84 309.45C331.66 308.55 330.24 308.03 329.15 306.94C312.4 290.09 295.44 273.42 278.8 256.43Z"
                                                                 fill="#ECB415" />
                                                             <path
                                                                 d="M278.8 256.43C279.46 256.498 280.1 256.699 280.681 257.02C281.262 257.342 281.772 257.777 282.18 258.3C298.8 274.967 315.427 291.61 332.06 308.23C332.37 308.614 332.638 309.029 332.86 309.47C331.54 309.55 330.22 309.7 328.86 309.71H135.68C132.52 309.71 129.41 309.63 126.41 308.24C123.25 306.78 122.55 305.62 125.47 302.76C139.84 288.67 154 274.34 168.24 260.1C181.42 246.92 194.607 233.747 207.8 220.58C212.61 215.78 213.88 215.8 218.8 220.68C230.22 232.093 241.63 243.513 253.03 254.94C261.89 263.81 269.3 264.24 278.8 256.43Z"
                                                                 fill="#FEC933" />
                                                             <path
                                                                 d="M191.89 149.74C183.464 149.712 175.236 147.186 168.247 142.481C161.257 137.776 155.821 131.103 152.624 123.308C149.428 115.512 148.615 106.943 150.29 98.6855C151.965 90.428 156.051 82.8527 162.032 76.9181C168.013 70.9834 175.619 66.9561 183.89 65.3455C192.16 63.735 200.722 64.6137 208.493 67.8705C216.263 71.1272 222.894 76.6156 227.544 83.6414C232.195 90.6671 234.658 98.9145 234.62 107.34C234.536 118.616 229.996 129.402 221.991 137.345C213.987 145.287 203.167 149.743 191.89 149.74V149.74Z"
                                                                 fill="black" />
                                                             <path
                                                                 d="M191.79 117.72C189.021 117.7 186.37 116.601 184.398 114.658C182.426 112.714 181.29 110.078 181.23 107.31C181.276 104.528 182.405 101.873 184.378 99.9097C186.351 97.9467 189.011 96.8303 191.793 96.7978C194.576 96.7652 197.262 97.8191 199.28 99.7354C201.298 101.652 202.489 104.279 202.6 107.06C202.604 108.474 202.326 109.874 201.783 111.179C201.239 112.484 200.441 113.668 199.434 114.66C198.427 115.653 197.233 116.435 195.92 116.96C194.608 117.486 193.204 117.744 191.79 117.72V117.72Z"
                                                                 fill="#FDC833" />
                                                         </g>
                                                         <defs>
                                                             <clipPath id="clip0_0_1">
                                                                 <rect width="511.79" height="469.6" fill="white" />
                                                             </clipPath>
                                                         </defs>
                                                     </svg>
                                                     <h4>Add Nutritionist Image</h4> -->

                                                     <div class="text-center">
                                                       <img width="100" src="{{asset('images/default_img1.png')}}">

                                                       <p class="mt-2 font-weight-bold">No Image</p>
                                                   </div>
                                               </div>
                                               
                                           </div>
                                       </div>

                                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                                                <div class="form-group">
                                                    <label>{{ __('adminlte::adminlte.name') }}</label>
                                                    <input class="form-control" placeholder="{{ ucfirst($viewAdmin[0]->full_name) }}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                                                <div class="form-group">
                                                    <label>{{ __('adminlte::adminlte.email') }}</label>
                                                    <input class="form-control" placeholder="{{ $viewAdmin[0]->email }}">
                                                </div>
                                            </div>
                                            
                                               <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="full_name">Qualification </label>
                                                        <input type="text" name="qualification" class="form-control" id="qualification"
                                                            maxlength="100"  value="{{ $admin->qualification ?? '' }}" autocomplete="nope" readonly>
                                                        
                                                    </div>
                                                </div>

                                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                                                <div class="form-group">
                                                    <label>{{ __('adminlte::adminlte.role') }}</label>
                                                    <?php $role = \App\Models\Role::where('id', $viewAdmin[0]->role_id)->get(); ?>
                                                    <input class="form-control" placeholder="{{ $role[0]->name }}">
                                                </div>
                                            </div>
                                           

                                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                                                <div class="form-group">
                                                    <label>{{ __('adminlte::adminlte.created_date') }}</label>
                                                    <input class="form-control"
                                                        placeholder="{{ $viewAdmin[0]->created_at ? date('m/d/y H:i:A', strtotime($viewAdmin[0]->created_at)) : '' }}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                                                <div class="form-group">
                                                    <label>{{ __('adminlte::adminlte.last_updated_date') }}</label>
                                                    <input class="form-control"
                                                        placeholder="{{ $viewAdmin[0]->updated_at ? date('m/d/y H:i:A', strtotime($viewAdmin[0]->updated_at)) : '' }}">
                                                </div>
                                            </div>

                                             <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12">
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <input class="form-control"
                                                        placeholder="{{ $role[0]->status == 1 ? 'Active' : 'Inactive' }}">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection


@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/css/intlTelInput.css" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/css/intlTelInput.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.css" />

<style>
    .information_fields {
        margin-bottom: 30px;
    }

    .address_fields {
        margin-top: 30px;
    }
</style>

<style>
    /* start mk profile upload coding */
    .profile-image-show {
        height: 161px;
        width: 161px;
        border-radius: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #ffffff;
        border: 7px solid #dcf7d5;
        position: relative;
        margin: 0 0 20px;
        cursor: pointer;
    }

    .upload_image_wrapper {
        padding: 16px 25px 16px 25px;
        background-color: #ffffff !important;
        border: 1px solid #F0EFEF;
        height: 60px;
        box-shadow: none;
        outline-style: none;
        font-size: 13px;
        line-height: normal;
        color: #1c1c1c;
        border-radius: 10px;
        position: relative;
    }

    .upload_image_wrapper input#news_source_website_image_1 {
        position: absolute;
        top: 0;
        left: 0;
        opacity: 0;
        z-index: 1;
        cursor: pointer;
    }

    input[type=file],
    /* FF, IE7+, chrome (except button) */
    input[type=file]::-webkit-file-upload-button {
        /* chromes and blink button */
        cursor: pointer;
    }

    .upload_image_wrapper i.far.fa-image {
        font-size: 28px;
    }


    .profile-image-show {
        background-color: #f6f7fb;
        border-radius: 20px;
        border: 1px dashed #878D8E !important;
        width: 200px;
        height: 200px;
        margin: 0px 0 20px;
        /*overflow: hidden;*/
        padding: 10px;
    }

    .remove-pro-img {
        position: absolute;
        top: -10px;
        right: -10px;
        z-index: 9;
    }

    .profile-image-show img#profileImage {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 10px;
    }

    .thumb_nails {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    .thumb_nails h4 {
        font-size: 14px;
        width: 100%;
        text-align: center;
        margin: 10px 0 0;
        font-weight: 600;
    }

    #profile_picture {
        border: 1px solid red;
        width: 100% !important;
        height: 100% !important;
        border-radius: 20%;
        position: absolute;
        opacity: 0;
    }


    /* end mk profile upload coding */


    .editable_field {
        position: relative;
        top: -25px;
        right: 10px;
        float: right;
    }

    .non_editable_field {
        position: relative;
        top: -25px;
        right: 10px;
        float: right;
    }

    #job_alerts_modal label.error {
        position: absolute;
        bottom: -12px;
        left: 17px;
    }
</style>



@stop


@section('js')
@stop
