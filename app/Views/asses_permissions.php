<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>

<style>
    @import url("https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,300;1,400;1,500;1,700;1,900&display=swap");

    * {
        box-sizing: border-box;
        font-family: "Roboto", sans-serif;
    }

    .c-wa-message {
        padding: 7px 14px 6px;
        background-color: #724EBF;
        border-radius: 0px 8px 8px;

    }


    .chat_bordClass {
        max-height: 90% !important;
    }

    .c-wa-message:before {
        position: absolute;
        background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAmCAMAAADp2asXAAAABGdBTUEAALGPC/xhBQAAAAFzUkdCAK7OHOkAAACQUExURUxpccPDw9ra2m9vbwAAAAAAADExMf///wAAABoaGk9PT7q6uqurqwsLCycnJz4+PtDQ0JycnIyMjPf3915eXvz8/E9PT/39/RMTE4CAgAAAAJqamv////////r6+u/v7yUlJeXl5f///5ycnOXl5XNzc/Hx8f///xUVFf///+zs7P///+bm5gAAAM7Ozv///2fVensAAAAvdFJOUwCow1cBCCnqAhNAnY0WIDW2f2/hSeo99g1lBYT87vDXG8/6d8oL4sgM5szrkgl660OiZwAAAHRJREFUKM/ty7cSggAABNFVUQFzwizmjPz/39k4YuFWtm55bw7eHR6ny63+alnswT3/rIDzUSC7CrAziPYCJCsB+gbVkgDtVIDh+DsE9OTBpCtAbSBAZSEQNgWIygJ0RgJMDWYNAdYbAeKtAHODlkHIv997AkLqIVOXVU84AAAAAElFTkSuQmCC);
        background-position: 50% 50%;
        background-repeat: no-repeat;
        background-size: contain;
        content: "";
        top: 0px;
        left: -12px;
        width: 12px;
        height: 19px;
    }

    .c-wa-audio__wrapper {
        display: flex;
        align-items: center;
        width: 400px;
    }

    .c-wa-audio__photo {
        background-image: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiPz4KPCFET0NUWVBFIHN2ZyAgUFVCTElDICctLy9XM0MvL0RURCBTVkcgMS4xLy9FTicgICdodHRwOi8vd3d3LnczLm9yZy9HcmFwaGljcy9TVkcvMS4xL0RURC9zdmcxMS5kdGQnPgo8c3ZnIHdpZHRoPSI0MDFweCIgaGVpZ2h0PSI0MDFweCIgZW5hYmxlLWJhY2tncm91bmQ9Im5ldyAzMTIuODA5IDAgNDAxIDQwMSIgdmVyc2lvbj0iMS4xIiB2aWV3Qm94PSIzMTIuODA5IDAgNDAxIDQwMSIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPGcgdHJhbnNmb3JtPSJtYXRyaXgoMS4yMjMgMCAwIDEuMjIzIC00NjcuNSAtODQzLjQ0KSI+Cgk8cmVjdCB4PSI2MDEuNDUiIHk9IjY1My4wNyIgd2lkdGg9IjQwMSIgaGVpZ2h0PSI0MDEiIGZpbGw9IiNFNEU2RTciLz4KCTxwYXRoIGQ9Im04MDIuMzggOTA4LjA4Yy04NC41MTUgMC0xNTMuNTIgNDguMTg1LTE1Ny4zOCAxMDguNjJoMzE0Ljc5Yy0zLjg3LTYwLjQ0LTcyLjktMTA4LjYyLTE1Ny40MS0xMDguNjJ6IiBmaWxsPSIjRkZGRkZGIi8+Cgk8cGF0aCBkPSJtODgxLjM3IDgxOC44NmMwIDQ2Ljc0Ni0zNS4xMDYgODQuNjQxLTc4LjQxIDg0LjY0MXMtNzguNDEtMzcuODk1LTc4LjQxLTg0LjY0MSAzNS4xMDYtODQuNjQxIDc4LjQxLTg0LjY0MWM0My4zMSAwIDc4LjQxIDM3LjkgNzguNDEgODQuNjR6IiBmaWxsPSIjRkZGRkZGIi8+CjwvZz4KPC9zdmc+Cg==);
        background-position: center;
        background-size: cover;
        width: 45px;
        height: 45px;
        border-radius: 50%;
        border: 1px solid #ddd;
    }

    .c-wa-audio__photo-container {
        position: relative;
    }

    .c-wa-audio__photo-mic {
        position: absolute;
        right: 0;
        bottom: 0;
        font-size: 1.1rem;
        color: #999999;
        filter: drop-shadow(1px 1px 0 white) drop-shadow(-1px -1px 0 white);
    }

    .c-wa-audio__control-play {
        color: #999999;
        margin-left: 20px;
        cursor: pointer;
        font-size: 1.1rem;
    }

    .c-wa-audio__time-container {
        font-size: 16px;
        line-height: 18px;
        color: #55606e;
        display: flex;
        flex-grow: 1;

        align-items: center;
        margin-left: 24px;
        margin-right: 24px;
    }

    .c-wa-audio__time-slider {
        width: 155px;
        background-color: #d8d8d8;
        cursor: pointer;
        position: relative;
        margin-left: 16px;
        margin-right: 16px;
        border-radius: 2px;
        height: 4px;
    }

    .c-wa-audio__time-progress {
        background-color: #2ab5eb;
        border-radius: inherit;
        position: absolute;
        pointer-events: none;
        height: 4px;
    }

    .c-wa-audio__time-pin {
        height: 13px;
        width: 13px;
        border-radius: 50%;
        background-color: #2ab5eb;
        position: absolute;
        pointer-events: all;
        top: -4px;
        right: -10px;
        box-shadow: 0px 1px 1px 0px rgba(0, 0, 0, 0.32);
    }

    .iti {
        width: 100%;
    }

    .ChatBackGroundClass {
        background-image: url('https://user-images.githubusercontent.com/15075759/28719144-86dc0f70-73b1-11e7-911d-60d70fcded21.png') !important;

    }


    .chatheadercolorclass {
        background-color: #005c4b !important;
    }


    .chatheadercolorclasswithheader {
        background-color: #005c4b !important;
        border-color: #005c4b !important;
    }

    body {
        background-color: #f3f3f3;
    }

    .fs-12 {
        font-size: 12px;
    }

    .form-control:focus {
        box-shadow: 0px 0px 0px black;
    }

    .account-nav {
        cursor: pointer;
        background-color: white;
        overflow: hidden;
    }

    .account_icon {
        background-color: #f3f3f3;
        height: 40px;
        width: 40px;
        overflow: hidden;
        background-position: center;
        align-self: center;
    }

    .chat_loader {
        display: block;
        --height-of-loader: 4px;
        --loader-color: #7a00ff;
        width: 130px;
        height: var(--height-of-loader);
        border-radius: 30px;
        background-color: rgba(0, 0, 0, 0.2);
        position: relative;
    }

    .chat_loader::before {
        content: "";
        position: absolute;
        background: var(--loader-color);
        top: 0;
        left: 0;
        width: 0%;
        height: 100%;
        border-radius: 30px;
        animation: moving 1s ease-in-out infinite;
    }

    .active-tab {
        background-color: #007145;
    }

    @keyframes moving {
        50% {
            width: 100%;
        }

        100% {
            width: 0;
            right: 0;
            /* left: unset; */
        }
    }

    .account-box {
        background-color: white;
    }

    .active-account-box {
        background-color: #eaeaea9c;
        border-right: 1px solid #b55dcd;
    }

    .chat-account-box {
        background-color: white;
    }

    .chat-account-active {
        background-color: #eaeaea9c;
        border-right: 2px solid #724ebf;
    }

    .accordion_item_div {
        margin: 30px;
        margin-bottom: 55px;
    }

    .nav_item_ww:hover {
        cursor: pointer;
        background-color: azure;
    }

    .upload-btn-wrapper {
        position: relative;
        overflow: hidden;
        display: inline-block;
    }

    .ck-content .ck-placeholder {
        color: red;
    }

    .file-btn {
        border: 1px dashed var(--del-color) !important;
        background-color: white;
        padding: 8px 20px;
        border-radius: 8px;
        border: 1px dashed #c3c3c3 !important;
    }

    .upload-btn-wrapper input[type=file] {
        font-size: 100px;
        position: absolute;
        left: 0;
        top: 0;
        opacity: 0;
    }

    .ck-editor__editable {
        min-height: 150px;
        max-height: 170px
    }

    .ck.ck-editor__editable>.ck-placeholder::before {
        color: #c6c6c6;
        font-family: Poppins;
    }

    .view-file-link {
        background-color: #724ebf21;
        color: #724ebf;
    }

    .emoji_div_man {
        margin-left: 50px;
        margin-bottom: 50px;
    }

    .emoji_div span {
        cursor: pointer;
    }

    /* ===========  camera css ====== */
    .video-btn-sec {
        position: absolute;
        bottom: 25px;
        left: 50%;
        right: auto;
        transform: translate(-10%, 0);
        width: 100%;
    }

    .video-btn-sec button {
        width: 35px;
        height: 35px;
        border-radius: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid var(--first-color);
        background-color: var(--first-color);
        margin-right: 5px;
    }

    .video-btn-sec button i {
        color: #fff;
    }

    .video-btn-sec .switch-btn {
        width: fit-content;
        padding: 15px 15px;
        height: 40px;
        color: #fff;
    }

    .profile-div {
        width: 130px;
        height: 130px;
        overflow: hidden;
    }

    .profile-btn-photo2 {
        position: absolute;
        bottom: 0;
        right: 0;
    }

    .profile-btn-photo3 {
        position: absolute;
        bottom: 0;
        right: 30px;
    }

    .upload-btn-wrapper {
        position: relative;
        overflow: hidden;
        display: inline-block;
    }

    .upload-btn {
        width: 30px;
        height: 30px;
        border: 2px solid gray;
        color: gray;
        background-color: white;
        padding: 5px 5px;
        border-radius: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        line-height: normal;
    }

    .upload-btn i {
        line-height: 0;
    }

    .upload-btn-wrapper input[type=file] {
        font-size: 100px;
        position: absolute;
        left: 0;
        top: 0;
        right: 0;
        bottom: 0;
        opacity: 0;
        width: 100%;
        height: 100%;
    }

    @media (max-width:575px) {
        .title-1 h2 {
            font-size: 19px;
        }
    }

    .hover-text {
        overflow: hidden;
    }

    .hover-text:hover {
        overflow: visible;
        white-space: wrap !important;
    }

    .hover-text {
        overflow: hidden;
    }

    .hover-text:hover {
        overflow: visible;
        white-space: wrap !important;
    }

    .modal-body-1 {
        background-color: var(--white-color);
        border: 1px solid var(--all-light);
        display: flex;
        flex-wrap: wrap;
        align-items: start;
        justify-content: start;
        padding: 16px 8px;
        border-radius: 6px;
    }

    .chat-header {
        background-color: #724EBF;
    }

    .accordion-button:not(.collapsed) {
        color: black;
        background-color: transparent;
        box-shadow: inset 0 calc(-1 * var(--bs-accordion-border-width)) 0 var(--bs-accordion-border-color);
    }

    .account-box {
        transition: all 0.5s;
        cursor: pointer;
    }

    .account-box:hover {
        background-color: #eaeaea9c !important;
    }

    .linked-page1 {
        transition: all 0.5s;
        cursor: pointer;
    }

    .linked-page1:hover {
        background-color: #eaeaea9c !important;
    }

    .scroll-none::-webkit-scrollbar {
        display: none;
    }

    . .accordion-button:not(.collapsed)::after {
        display: none;
    }
</style>








<div class="main-dashbord p-2">
    <div class="container-fluid p-0">
        <div class="p-2">
            <div class="d-flex align-items-center title-1 mb-1">
                <!-- <i class="fa-solid fa-message"></i> -->
                <h2>Assign assets and Set Permission</h2>
            </div>

            <div class="col-12 d-flex flex-wrap mt-2">
                <!-- first-div -->
                <div class="d-lg-block col-12 col-sm-12 col-md-12 col-lg-6 col-xl-3  social-accounts main-box rounded-bottom-0"
                    style="height:80vh">
                    <div class="col-12 border rounded-3 bg-white position-lg-relative rounded-bottom-0" style="height:80vh">
                        <div class="chat-nav-search-bar p-2 col-12  rounded-top-3 ">
                            <div class="d-flex justify-content-between align-items-center ">
                                <div class="dropdown d-flex align-items-center ps-2 ">
                                    <h5 class="fs-5 fw-semibold ">Select assets Type</h5>
                                </div>
                            </div>
                        </div>
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item rounded-0 border-start-0 border-end-0">
                                <h2 class="accordion-header">
                                    <button
                                        class="accordion-button border-0 shadow-none fw-medium rounded-0 px-3 py-2 border-bottom "
                                        type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                        aria-expanded="true" aria-controls="collapseOne">
                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="30px" height="30px" x="0"
                                            y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512"
                                            xml:space="preserve" class="">
                                            <g>
                                                <path fill="#1877f2"
                                                    d="M512 256c0 127.78-93.62 233.69-216 252.89V330h59.65L367 256h-71v-48.02c0-20.25 9.92-39.98 41.72-39.98H370v-63s-29.3-5-57.31-5c-58.47 0-96.69 35.44-96.69 99.6V256h-65v74h65v178.89C93.62 489.69 0 383.78 0 256 0 114.62 114.62 0 256 0s256 114.62 256 256z"
                                                    opacity="1" data-original="#1877f2" class=""></path>
                                                <path fill="#ffffff"
                                                    d="M355.65 330 367 256h-71v-48.021c0-20.245 9.918-39.979 41.719-39.979H370v-63s-29.296-5-57.305-5C254.219 100 216 135.44 216 199.6V256h-65v74h65v178.889c13.034 2.045 26.392 3.111 40 3.111s26.966-1.066 40-3.111V330z"
                                                    opacity="1" data-original="#ffffff"></path>
                                            </g>
                                        </svg>
                                        <P class="ms-2">Facebook</P>

                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show"
                                    aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body p-0">
                                        <ul>
                                            <li
                                                class="cursor-pointer py-2 ps-5 account-box d-flex  flex-wrap align-items-center border-bottom">
                                                <img class="rounded-circle me-1"
                                                    src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFwAAABcCAMAAADUMSJqAAAAq1BMVEUrMUD8r0//////sk8UKD+2hEn/tFBxWkUoL0AiKTklLkAVHTEaKj9laXOkpqwhLEDfnk3m5+i7vcHppE6ZckcyNkH3rE9+YkXvp05ZXWhRR0KMa0ahd0isfklhUENPVF8zOUnJkEu/ikrQGx7PJinv8PHXmUw8QU/d3uAcIzV3e4M/M0J8LjmzHyWraG5vESGwsreVmJ7Jys1GS1gJFSu5q6/HvL80JzgAIj9vDd0LAAAEn0lEQVRogbWa22KiMBCGI+EQIBpUDhURLC1V3O3uFt3D+z/ZoqCSEENQnIuWtvD5MzNJJpkCpWHTYrJH4G5D+68ia/LA9XK2sA/5A+zScjsfFxx4sbbNh8C1mYdNwcCz8eExzQ1Dhx0F327yodBHs5PsCt+ag3jkauYmO8Oz9cDskp6c4eNBfVKZvavgs8Pw7JJenOBosDxpmrk/wmf2M9gAHIoSvhg8mpWZYwVkctFEFsFYLQ1jYsn50cxA0R1ORDDxQmMZrTRtFS2N0Ct/0f0BdgEmXcotDGL3dT7SdR2WVn4bzV/dGKlWx4P5BCzEEggOI2cE4Yiy8mcnCjERPooSIGRbOE59llzzdT+NSZd6wUerYYnmkWv+KA3VOwcJ8SJfv40+mu5Hntg3NwyHHwLVF/UfIe6NRjgQeaRB9wPc0zWIuFLoIx26EknfZFuaLPuI1yTHbK1b64gkbbrWQzuW9slZuysdVRz0ZJf0QJJOQm6ewNPkcvzCo/uhVL4jj5PfEPqOtgwMI3A1hzchwA9Pxu1q1HoU6o4bgnImLw1jELpOWz6MVCmnsM/pToDwNduQhVHgtNLJD7tnMZIyj8FR5LFjEGEvGjHi9bQzpiRmX/fF4A1vhI0Xhu7HXTHFKf0InMc3BOF4ztzaJd1iPA5fbsshMaO9y+tqxHjcEKjBBuP1SCgdAQf2uB3TUqAjXDSZcEJHPDKQR2sZCUPKzFh6PWOYHKvuD2jpwvmLvDbh0DnVqAgtxi1bVH+yKOnwVaAceXOOEHOicGxicl51LnCjFVIerFILJTy2oiQItFNXkIzEaLqwDj7aZzx2dtoOM+mlG7f9gpdNuK7V4dxN27bd1SGlFkR9eTuidN7q59jb5rqyb9+/f6svTZurRzAu1BX1jgE5K8+OYrPfn29vn7+r62mtnFDJCFe3J3WVKihg5cCrz3+8vb+//aB8XoaJekTrC79kCwWvsqUPnO+Wc57/+Xx///xD5TnrFgGcCWgdepQni8r+/vz5t75M6sMT7ErD+am4/zVr2a89LxVFcO4gAustbxBt16e3ogeRCP7w8BfBuRMXAgWPXSlnJi4RvDXlnooVtPmatOxrU83Gjjycv1ig3G5ZlSzMYtGh/MFlTgjvuUCrK7Y6E8HZ9bxfadEFf6go6oI/Us51w0nMVNBlIcrbgnMK0W54Kb1VQq+kSmgZOOv1kWzxLwO/d9siB7+94XIFGy5JOG9XVMkXbRVl4fdscuXh/bfnfeB9DxZ6wXseifSEnw5z7sDLweWPoe6BSx+gvdwFlzv6c6XLOdY1apjypqcLyk/Df4aoKBIft5I49flDspwQ0hhbRAhPHjsoFlS5aAEmXV0FS0W8I26AT3urUjm8mp424PkEFN0tC9HhvBWm2tXSZWPFtQuQybUsLm0FlWkrWGrTmqt5ngFl/MSGiCLRtLjLTq0cZfOUJhRaP7F9diie1/jL68ZfuaUcvmW5V2q4Mt0M3WwF0wtcyZJBu3/5/sS+dM93h8HEm0yD+7iBSgbBI/OQXLaWjX8q2O429mO9f9O2N7vGrrUBP/Jnu/X97P1uRu+H/wOz32TOcdH3qgAAAABJRU5ErkJggg=="
                                                    alt="" style="width:30px;height:30px">
                                                <p class="col">Ajasys all</p>
                                            </li>
                                            <li
                                                class="cursor-pointer py-2 ps-5 account-box d-flex  flex-wrap align-items-center border-bottom">
                                                <img class="rounded-circle me-1"
                                                    src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFwAAABcCAMAAADUMSJqAAAAq1BMVEUrMUD8r0//////sk8UKD+2hEn/tFBxWkUoL0AiKTklLkAVHTEaKj9laXOkpqwhLEDfnk3m5+i7vcHppE6ZckcyNkH3rE9+YkXvp05ZXWhRR0KMa0ahd0isfklhUENPVF8zOUnJkEu/ikrQGx7PJinv8PHXmUw8QU/d3uAcIzV3e4M/M0J8LjmzHyWraG5vESGwsreVmJ7Jys1GS1gJFSu5q6/HvL80JzgAIj9vDd0LAAAEn0lEQVRogbWa22KiMBCGI+EQIBpUDhURLC1V3O3uFt3D+z/ZoqCSEENQnIuWtvD5MzNJJpkCpWHTYrJH4G5D+68ia/LA9XK2sA/5A+zScjsfFxx4sbbNh8C1mYdNwcCz8eExzQ1Dhx0F327yodBHs5PsCt+ag3jkauYmO8Oz9cDskp6c4eNBfVKZvavgs8Pw7JJenOBosDxpmrk/wmf2M9gAHIoSvhg8mpWZYwVkctFEFsFYLQ1jYsn50cxA0R1ORDDxQmMZrTRtFS2N0Ct/0f0BdgEmXcotDGL3dT7SdR2WVn4bzV/dGKlWx4P5BCzEEggOI2cE4Yiy8mcnCjERPooSIGRbOE59llzzdT+NSZd6wUerYYnmkWv+KA3VOwcJ8SJfv40+mu5Hntg3NwyHHwLVF/UfIe6NRjgQeaRB9wPc0zWIuFLoIx26EknfZFuaLPuI1yTHbK1b64gkbbrWQzuW9slZuysdVRz0ZJf0QJJOQm6ewNPkcvzCo/uhVL4jj5PfEPqOtgwMI3A1hzchwA9Pxu1q1HoU6o4bgnImLw1jELpOWz6MVCmnsM/pToDwNduQhVHgtNLJD7tnMZIyj8FR5LFjEGEvGjHi9bQzpiRmX/fF4A1vhI0Xhu7HXTHFKf0InMc3BOF4ztzaJd1iPA5fbsshMaO9y+tqxHjcEKjBBuP1SCgdAQf2uB3TUqAjXDSZcEJHPDKQR2sZCUPKzFh6PWOYHKvuD2jpwvmLvDbh0DnVqAgtxi1bVH+yKOnwVaAceXOOEHOicGxicl51LnCjFVIerFILJTy2oiQItFNXkIzEaLqwDj7aZzx2dtoOM+mlG7f9gpdNuK7V4dxN27bd1SGlFkR9eTuidN7q59jb5rqyb9+/f6svTZurRzAu1BX1jgE5K8+OYrPfn29vn7+r62mtnFDJCFe3J3WVKihg5cCrz3+8vb+//aB8XoaJekTrC79kCwWvsqUPnO+Wc57/+Xx///xD5TnrFgGcCWgdepQni8r+/vz5t75M6sMT7ErD+am4/zVr2a89LxVFcO4gAustbxBt16e3ogeRCP7w8BfBuRMXAgWPXSlnJi4RvDXlnooVtPmatOxrU83Gjjycv1ig3G5ZlSzMYtGh/MFlTgjvuUCrK7Y6E8HZ9bxfadEFf6go6oI/Us51w0nMVNBlIcrbgnMK0W54Kb1VQq+kSmgZOOv1kWzxLwO/d9siB7+94XIFGy5JOG9XVMkXbRVl4fdscuXh/bfnfeB9DxZ6wXseifSEnw5z7sDLweWPoe6BSx+gvdwFlzv6c6XLOdY1apjypqcLyk/Df4aoKBIft5I49flDspwQ0hhbRAhPHjsoFlS5aAEmXV0FS0W8I26AT3urUjm8mp424PkEFN0tC9HhvBWm2tXSZWPFtQuQybUsLm0FlWkrWGrTmqt5ngFl/MSGiCLRtLjLTq0cZfOUJhRaP7F9diie1/jL68ZfuaUcvmW5V2q4Mt0M3WwF0wtcyZJBu3/5/sS+dM93h8HEm0yD+7iBSgbBI/OQXLaWjX8q2O429mO9f9O2N7vGrrUBP/Jnu/X97P1uRu+H/wOz32TOcdH3qgAAAABJRU5ErkJggg=="
                                                    alt="" style="width:30px;height:30px">
                                                <p class="col">Ajasys all</p>
                                            </li>
                                            <li
                                                class="cursor-pointer py-2 ps-5 account-box d-flex  flex-wrap align-items-center ">
                                                <img class="rounded-circle me-1"
                                                    src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFwAAABcCAMAAADUMSJqAAAAq1BMVEUrMUD8r0//////sk8UKD+2hEn/tFBxWkUoL0AiKTklLkAVHTEaKj9laXOkpqwhLEDfnk3m5+i7vcHppE6ZckcyNkH3rE9+YkXvp05ZXWhRR0KMa0ahd0isfklhUENPVF8zOUnJkEu/ikrQGx7PJinv8PHXmUw8QU/d3uAcIzV3e4M/M0J8LjmzHyWraG5vESGwsreVmJ7Jys1GS1gJFSu5q6/HvL80JzgAIj9vDd0LAAAEn0lEQVRogbWa22KiMBCGI+EQIBpUDhURLC1V3O3uFt3D+z/ZoqCSEENQnIuWtvD5MzNJJpkCpWHTYrJH4G5D+68ia/LA9XK2sA/5A+zScjsfFxx4sbbNh8C1mYdNwcCz8eExzQ1Dhx0F327yodBHs5PsCt+ag3jkauYmO8Oz9cDskp6c4eNBfVKZvavgs8Pw7JJenOBosDxpmrk/wmf2M9gAHIoSvhg8mpWZYwVkctFEFsFYLQ1jYsn50cxA0R1ORDDxQmMZrTRtFS2N0Ct/0f0BdgEmXcotDGL3dT7SdR2WVn4bzV/dGKlWx4P5BCzEEggOI2cE4Yiy8mcnCjERPooSIGRbOE59llzzdT+NSZd6wUerYYnmkWv+KA3VOwcJ8SJfv40+mu5Hntg3NwyHHwLVF/UfIe6NRjgQeaRB9wPc0zWIuFLoIx26EknfZFuaLPuI1yTHbK1b64gkbbrWQzuW9slZuysdVRz0ZJf0QJJOQm6ewNPkcvzCo/uhVL4jj5PfEPqOtgwMI3A1hzchwA9Pxu1q1HoU6o4bgnImLw1jELpOWz6MVCmnsM/pToDwNduQhVHgtNLJD7tnMZIyj8FR5LFjEGEvGjHi9bQzpiRmX/fF4A1vhI0Xhu7HXTHFKf0InMc3BOF4ztzaJd1iPA5fbsshMaO9y+tqxHjcEKjBBuP1SCgdAQf2uB3TUqAjXDSZcEJHPDKQR2sZCUPKzFh6PWOYHKvuD2jpwvmLvDbh0DnVqAgtxi1bVH+yKOnwVaAceXOOEHOicGxicl51LnCjFVIerFILJTy2oiQItFNXkIzEaLqwDj7aZzx2dtoOM+mlG7f9gpdNuK7V4dxN27bd1SGlFkR9eTuidN7q59jb5rqyb9+/f6svTZurRzAu1BX1jgE5K8+OYrPfn29vn7+r62mtnFDJCFe3J3WVKihg5cCrz3+8vb+//aB8XoaJekTrC79kCwWvsqUPnO+Wc57/+Xx///xD5TnrFgGcCWgdepQni8r+/vz5t75M6sMT7ErD+am4/zVr2a89LxVFcO4gAustbxBt16e3ogeRCP7w8BfBuRMXAgWPXSlnJi4RvDXlnooVtPmatOxrU83Gjjycv1ig3G5ZlSzMYtGh/MFlTgjvuUCrK7Y6E8HZ9bxfadEFf6go6oI/Us51w0nMVNBlIcrbgnMK0W54Kb1VQq+kSmgZOOv1kWzxLwO/d9siB7+94XIFGy5JOG9XVMkXbRVl4fdscuXh/bfnfeB9DxZ6wXseifSEnw5z7sDLweWPoe6BSx+gvdwFlzv6c6XLOdY1apjypqcLyk/Df4aoKBIft5I49flDspwQ0hhbRAhPHjsoFlS5aAEmXV0FS0W8I26AT3urUjm8mp424PkEFN0tC9HhvBWm2tXSZWPFtQuQybUsLm0FlWkrWGrTmqt5ngFl/MSGiCLRtLjLTq0cZfOUJhRaP7F9diie1/jL68ZfuaUcvmW5V2q4Mt0M3WwF0wtcyZJBu3/5/sS+dM93h8HEm0yD+7iBSgbBI/OQXLaWjX8q2O429mO9f9O2N7vGrrUBP/Jnu/X97P1uRu+H/wOz32TOcdH3qgAAAABJRU5ErkJggg=="
                                                    alt="" style="width:30px;height:30px">
                                                <p class="col">Ajasys all</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- second-div -->
                <div class="d-lg-block col-12 col-sm-12 col-md-12 col-lg-6 col-xl-3  social-accounts main-box rounded-bottom-0"
                    style="height:80vh">
                    <div class="col-12 border rounded-3 bg-white position-lg-relative rounded-bottom-0" style="height:80vh">
                        <div class="chat-nav-search-bar p-2 col-12  rounded-top-3 border-bottom">
                            <div class="d-flex justify-content-between align-items-center ">
                                <div class="dropdown d-flex align-items-center ps-2 ">
                                    <h5 class="fs-5 fw-semibold ">Select assets</h5>
                                </div>
                            </div>
                        </div>
                        <div
                            class="cursor-pointer py-2 ps-3 account-box d-flex  flex-wrap  border-bottom alihgn-items-center">
                            <input type="checkbox" id="selectall" class="me-2 rounded-3 select_all_checkbox" style="width:18px;height:18px;">
                            <p class="col fs-6 fw-semibold">Select all</p>
                        </div>
                        <ul class="">
                            <li
                                class="cursor-pointer py-2 ps-3 account-box d-flex  flex-wrap align-items-center active-account-box select_part_checkbox">
                                <input type="checkbox"  class="me-2 rounded-3 selectedId" name="selectedId" style="width:18px;height:18px;">
                                <img class="rounded-circle me-1"
                                    src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFwAAABcCAMAAADUMSJqAAAAq1BMVEUrMUD8r0//////sk8UKD+2hEn/tFBxWkUoL0AiKTklLkAVHTEaKj9laXOkpqwhLEDfnk3m5+i7vcHppE6ZckcyNkH3rE9+YkXvp05ZXWhRR0KMa0ahd0isfklhUENPVF8zOUnJkEu/ikrQGx7PJinv8PHXmUw8QU/d3uAcIzV3e4M/M0J8LjmzHyWraG5vESGwsreVmJ7Jys1GS1gJFSu5q6/HvL80JzgAIj9vDd0LAAAEn0lEQVRogbWa22KiMBCGI+EQIBpUDhURLC1V3O3uFt3D+z/ZoqCSEENQnIuWtvD5MzNJJpkCpWHTYrJH4G5D+68ia/LA9XK2sA/5A+zScjsfFxx4sbbNh8C1mYdNwcCz8eExzQ1Dhx0F327yodBHs5PsCt+ag3jkauYmO8Oz9cDskp6c4eNBfVKZvavgs8Pw7JJenOBosDxpmrk/wmf2M9gAHIoSvhg8mpWZYwVkctFEFsFYLQ1jYsn50cxA0R1ORDDxQmMZrTRtFS2N0Ct/0f0BdgEmXcotDGL3dT7SdR2WVn4bzV/dGKlWx4P5BCzEEggOI2cE4Yiy8mcnCjERPooSIGRbOE59llzzdT+NSZd6wUerYYnmkWv+KA3VOwcJ8SJfv40+mu5Hntg3NwyHHwLVF/UfIe6NRjgQeaRB9wPc0zWIuFLoIx26EknfZFuaLPuI1yTHbK1b64gkbbrWQzuW9slZuysdVRz0ZJf0QJJOQm6ewNPkcvzCo/uhVL4jj5PfEPqOtgwMI3A1hzchwA9Pxu1q1HoU6o4bgnImLw1jELpOWz6MVCmnsM/pToDwNduQhVHgtNLJD7tnMZIyj8FR5LFjEGEvGjHi9bQzpiRmX/fF4A1vhI0Xhu7HXTHFKf0InMc3BOF4ztzaJd1iPA5fbsshMaO9y+tqxHjcEKjBBuP1SCgdAQf2uB3TUqAjXDSZcEJHPDKQR2sZCUPKzFh6PWOYHKvuD2jpwvmLvDbh0DnVqAgtxi1bVH+yKOnwVaAceXOOEHOicGxicl51LnCjFVIerFILJTy2oiQItFNXkIzEaLqwDj7aZzx2dtoOM+mlG7f9gpdNuK7V4dxN27bd1SGlFkR9eTuidN7q59jb5rqyb9+/f6svTZurRzAu1BX1jgE5K8+OYrPfn29vn7+r62mtnFDJCFe3J3WVKihg5cCrz3+8vb+//aB8XoaJekTrC79kCwWvsqUPnO+Wc57/+Xx///xD5TnrFgGcCWgdepQni8r+/vz5t75M6sMT7ErD+am4/zVr2a89LxVFcO4gAustbxBt16e3ogeRCP7w8BfBuRMXAgWPXSlnJi4RvDXlnooVtPmatOxrU83Gjjycv1ig3G5ZlSzMYtGh/MFlTgjvuUCrK7Y6E8HZ9bxfadEFf6go6oI/Us51w0nMVNBlIcrbgnMK0W54Kb1VQq+kSmgZOOv1kWzxLwO/d9siB7+94XIFGy5JOG9XVMkXbRVl4fdscuXh/bfnfeB9DxZ6wXseifSEnw5z7sDLweWPoe6BSx+gvdwFlzv6c6XLOdY1apjypqcLyk/Df4aoKBIft5I49flDspwQ0hhbRAhPHjsoFlS5aAEmXV0FS0W8I26AT3urUjm8mp424PkEFN0tC9HhvBWm2tXSZWPFtQuQybUsLm0FlWkrWGrTmqt5ngFl/MSGiCLRtLjLTq0cZfOUJhRaP7F9diie1/jL68ZfuaUcvmW5V2q4Mt0M3WwF0wtcyZJBu3/5/sS+dM93h8HEm0yD+7iBSgbBI/OQXLaWjX8q2O429mO9f9O2N7vGrrUBP/Jnu/X97P1uRu+H/wOz32TOcdH3qgAAAABJRU5ErkJggg=="
                                    alt="" style="width:30px;height:30px">
                                <p class="col">Ajasys all</p>
                            </li>
                            <li class="cursor-pointer py-2 ps-3 account-box d-flex  flex-wrap align-items-center select_part_checkbox">
                                <input type="checkbox" id="checkbox-1-2" class="me-2 rounded-3 selectedId" name="selectedId" style="width:18px;height:18px;">
                                <img class="rounded-circle me-1"
                                    src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFwAAABcCAMAAADUMSJqAAAAq1BMVEUrMUD8r0//////sk8UKD+2hEn/tFBxWkUoL0AiKTklLkAVHTEaKj9laXOkpqwhLEDfnk3m5+i7vcHppE6ZckcyNkH3rE9+YkXvp05ZXWhRR0KMa0ahd0isfklhUENPVF8zOUnJkEu/ikrQGx7PJinv8PHXmUw8QU/d3uAcIzV3e4M/M0J8LjmzHyWraG5vESGwsreVmJ7Jys1GS1gJFSu5q6/HvL80JzgAIj9vDd0LAAAEn0lEQVRogbWa22KiMBCGI+EQIBpUDhURLC1V3O3uFt3D+z/ZoqCSEENQnIuWtvD5MzNJJpkCpWHTYrJH4G5D+68ia/LA9XK2sA/5A+zScjsfFxx4sbbNh8C1mYdNwcCz8eExzQ1Dhx0F327yodBHs5PsCt+ag3jkauYmO8Oz9cDskp6c4eNBfVKZvavgs8Pw7JJenOBosDxpmrk/wmf2M9gAHIoSvhg8mpWZYwVkctFEFsFYLQ1jYsn50cxA0R1ORDDxQmMZrTRtFS2N0Ct/0f0BdgEmXcotDGL3dT7SdR2WVn4bzV/dGKlWx4P5BCzEEggOI2cE4Yiy8mcnCjERPooSIGRbOE59llzzdT+NSZd6wUerYYnmkWv+KA3VOwcJ8SJfv40+mu5Hntg3NwyHHwLVF/UfIe6NRjgQeaRB9wPc0zWIuFLoIx26EknfZFuaLPuI1yTHbK1b64gkbbrWQzuW9slZuysdVRz0ZJf0QJJOQm6ewNPkcvzCo/uhVL4jj5PfEPqOtgwMI3A1hzchwA9Pxu1q1HoU6o4bgnImLw1jELpOWz6MVCmnsM/pToDwNduQhVHgtNLJD7tnMZIyj8FR5LFjEGEvGjHi9bQzpiRmX/fF4A1vhI0Xhu7HXTHFKf0InMc3BOF4ztzaJd1iPA5fbsshMaO9y+tqxHjcEKjBBuP1SCgdAQf2uB3TUqAjXDSZcEJHPDKQR2sZCUPKzFh6PWOYHKvuD2jpwvmLvDbh0DnVqAgtxi1bVH+yKOnwVaAceXOOEHOicGxicl51LnCjFVIerFILJTy2oiQItFNXkIzEaLqwDj7aZzx2dtoOM+mlG7f9gpdNuK7V4dxN27bd1SGlFkR9eTuidN7q59jb5rqyb9+/f6svTZurRzAu1BX1jgE5K8+OYrPfn29vn7+r62mtnFDJCFe3J3WVKihg5cCrz3+8vb+//aB8XoaJekTrC79kCwWvsqUPnO+Wc57/+Xx///xD5TnrFgGcCWgdepQni8r+/vz5t75M6sMT7ErD+am4/zVr2a89LxVFcO4gAustbxBt16e3ogeRCP7w8BfBuRMXAgWPXSlnJi4RvDXlnooVtPmatOxrU83Gjjycv1ig3G5ZlSzMYtGh/MFlTgjvuUCrK7Y6E8HZ9bxfadEFf6go6oI/Us51w0nMVNBlIcrbgnMK0W54Kb1VQq+kSmgZOOv1kWzxLwO/d9siB7+94XIFGy5JOG9XVMkXbRVl4fdscuXh/bfnfeB9DxZ6wXseifSEnw5z7sDLweWPoe6BSx+gvdwFlzv6c6XLOdY1apjypqcLyk/Df4aoKBIft5I49flDspwQ0hhbRAhPHjsoFlS5aAEmXV0FS0W8I26AT3urUjm8mp424PkEFN0tC9HhvBWm2tXSZWPFtQuQybUsLm0FlWkrWGrTmqt5ngFl/MSGiCLRtLjLTq0cZfOUJhRaP7F9diie1/jL68ZfuaUcvmW5V2q4Mt0M3WwF0wtcyZJBu3/5/sS+dM93h8HEm0yD+7iBSgbBI/OQXLaWjX8q2O429mO9f9O2N7vGrrUBP/Jnu/X97P1uRu+H/wOz32TOcdH3qgAAAABJRU5ErkJggg=="
                                    alt="" style="width:30px;height:30px">
                                <p class="col">Ajasys all</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- third-div -->
                <div class="d-none col-12 col-sm-12 col-md-12 col-lg-6 d-xl-block col-xxl-6 transcript_box  main-box rounded-bottom-0"
                    style="height:80vh">
                    <div class="col-12 border rounded-end-4 bg-white position-relative SetChatBackGroundClass rounded-3 overflow-hidden rounded-bottom-0"
                        style="height:80vh">
                        <div class="chat-nav-search-bar p-2 col-12 rounded-top-3 border-bottom">
                            <div class="d-flex justify-content-between align-items-center ">
                                <div class="dropdown d-flex align-items-center ps-2 ">
                                    <h5 class="fs-5 fw-semibold ">Assign Permission</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-2">
                            <div class="col-12">
                                <div class="main-selectpicker col-3">
                                    <select id="facebookpages" class="selectpicker form-control form-main"
                                        data-live-search="true" required>
                                        <option value="">select user</option>
                                        <option value="">User 1</option>
                                        <option value="">User 2</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <ul class="">
                                    <li
                                        class="cursor-pointer py-1 ps-3  d-flex  flex-wrap align-items-center">
                                        <input type="checkbox" class="me-2 rounded-3" style="width:18px;height:18px;">
                                        <p class="col fs-14">View</p>
                                    </li>
                                    <li
                                        class="cursor-pointer py-1 ps-3  d-flex  flex-wrap align-items-center ">
                                        <input type="checkbox" class="me-2 rounded-3" style="width:18px;height:18px;">
                                        <p class="col fs-14">Edit</p>
                                    </li>
                                    <li
                                        class="cursor-pointer py-1 ps-3  d-flex  flex-wrap align-items-center ">
                                        <input type="checkbox" class="me-2 rounded-3" style="width:18px;height:18px;">
                                        <p class="col fs-14">Update</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-12 bg-white d-flex justify-content-end  py-2 px-1 border  ">
                <button class="btn btn-secondary me-2">Cancle</button>
                <button class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </div>
</div>




<?= $this->include('partials/footer') ?>
<script>
    $('body').on('click', '.account-box', function () {

        $(this).addClass('active-account-box');
        $(this).siblings().removeClass('active-account-box');

    });
    // $('body').on('change','.select_all_checkbox',function(){
    //     if(this.checked) {
    //         alert('kjhsdd');
    //         $('.select_part_checkbox').prop('checked',true);
    //     }
        
    // })
    
    $(document).ready(function () {
        $('#selectall').click(function () {
            $('.selectedId').prop('checked', this.checked);
        });

        $('.selectedId').change(function () {
            var check = ($('.selectedId').filter(":checked").length == $('.selectedId').length);
            $('#selectall').prop("checked", check);
        });
    });
</script>