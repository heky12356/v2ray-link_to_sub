class PageRedirector {
    constructor() {
        this.pages = {
            page1: './src/php/dbview.php',
            page2: './src/php/enurldex.php',
            page3: './src/html/dbadd.html',
            page4: './src/php/urlviewpre.php',
            page5: './src/html/sub.html',
            page6: './src/html/usradd.html',
            page7: './src/html/otherurl.html',
            page8: './src/php/ourlview.php'
        };
    }

    redirectTo(pageKey) {
        if (this.pages[pageKey]) {
            window.location.href = this.pages[pageKey];
        } else {
            console.error(`Page key "${pageKey}" not found.`);
        }
    }
}

// 实例化 PageRedirector 类
const redirector = new PageRedirector();

// 全局函数用于在 HTML 中调用
function redirectToPage(pageKey) {
    redirector.redirectTo(pageKey);
}
