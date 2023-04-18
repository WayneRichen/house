<?php ?>
<nav class="bg-white border-gray-500 px-2 sm:px-4 py-2 dark:bg-gray-800 fixed top-0 z-10 w-full">
  <div class="container flex flex-wrap justify-between items-center mx-auto">
    <a href="./index.php" class="flex items-center">
      <img src="./static/image/logo.png" class="mr-2 h-16 sm:h-16" alt="Logo" />
      <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">看房網</span>
    </a>
    <button data-collapse-toggle="mobile-menu" type="button"
      class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
      aria-controls="mobile-menu" aria-expanded="false">
      <span class="sr-only">Open main menu</span>
      <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd"
          d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
          clip-rule="evenodd"></path>
      </svg>
      <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd"
          d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
          clip-rule="evenodd"></path>
      </svg>
    </button>
    <div class="hidden w-full md:flex md:w-auto flex-row" id="mobile-menu">
      <ul class="flex flex-col mt-4 md:flex-row md:space-x-8 md:mt-0 md:text-bg md:font-medium items-center">
        <li>
          <a href="./index.php"
            class="block py-2 pr-4 pl-3 text-gray-700 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent"
            aria-current="page">首頁</a>
        </li>
        <form action="./search.php" method="GET">
          <select name="region" id="region"
            class="form-select appearance-none block w-48 px-3 mt-4 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
            <option selected>請選擇租屋地點</option>
            <optgroup label="台中市">
              <option value="南屯區">南屯區</option>
              <option value="烏日區">烏日區</option>
              <option value="西屯區">西屯區</option>
              <option value="清水區">清水區</option>
              <option value="沙鹿區">沙鹿區</option>
              <option value="大甲區">大甲區</option>
              <option value="西區">西區</option>
              <option value="南區">南區</option>
            </optgroup>
            <optgroup label="台北市">
              <option value="信義區">信義區</option>
              <option value="中正區">中正區</option>
              <option value="萬華區">萬華區</option>
              <option value="大同區">大同區</option>
              <option value="中山區">中山區</option>
              <option value="大安區">大安區</option>
              <option value="士林區">士林區</option>
              <option value="北投區">北投區</option>
            </optgroup>
          </select>
        </form>
        <li>
          <a href="./faq.php"
            class="block py-2 pr-4 pl-3 text-gray-700 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">常見問題</a>
        </li>
        <?php if (isset($_SESSION['user_name'])): ?>
        <li class="flex flex-row">
          <span class="text-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"><?= 'Hello, '.$_SESSION['user_name'] ?></span>
          <span
            class="text-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">&nbsp;</span>
          <?php if ($_SESSION['user_type'] === 'landlord'): ?>
          <a href="./house-manage.php"
            class="block py-2 pr-4 pl-3 text-gray-700 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">後台管理</a>
          <span
            class="text-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">&nbsp;</span>
          <?php else: ?>
          <a href="./member.php"
            class="block py-2 pr-4 pl-3 text-gray-700 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">會員中心</a>
          <span
            class="text-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">&nbsp;</span>
          <?php endif; ?>
          <a href="./login.php?logout"
            class="block py-2 pr-4 pl-3 text-gray-700 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">登出</a>
        </li>
        <?php else: ?>
        <li class="flex flex-row">
          <a href="./login.php"
            class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">登入</a>
          <span
            class="text-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">&nbsp;&frasl;&nbsp;</span>
          <a href="./register.php"
            class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">註冊</a>
        </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>