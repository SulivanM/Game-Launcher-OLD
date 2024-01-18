<!DOCTYPE html>
<html>

<head>
  <title>Loading</title>
  <style>
    body {
      background-color: #000;
      overflow: hidden;
    }

    .preloader-container {
      display: flex;
      justify-content: center;
      align-items: center;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: #000;
      z-index: 9999;
      transition: opacity 0.5s ease;
    }

    .loader {
      height: 50px;
      display: flex;
      justify-content: center;
      align-items: center;
      animation: flippx 2s infinite linear;
    }

    .loader:before {
      content: "";
      position: absolute;
      inset: 0;
      margin: auto;
      width: 20px;
      height: 20px;
      border-radius: 50%;
      background: #fff;
      transform-origin: -24px 50%;
      animation: spin 1s infinite linear;
    }

    .loader:after {
      content: "";
      position: absolute;
      left: 50%;
      top: 50%;
      transform: translate(-50%, -50%);
      background: #fff;
      width: 48px;
      height: 48px;
      border-radius: 50%;
    }

    @keyframes flippx {

      0%,
      49% {
        transform: scaleX(1);
      }

      50%,
      100% {
        transform: scaleX(-1);
      }
    }

    @keyframes spin {
      100% {
        transform: rotate(360deg);
      }
    }
  </style>
</head>

<body>
  <div class="preloader-container">
    <span class="loader"></span>
  </div>
</body>

</html>