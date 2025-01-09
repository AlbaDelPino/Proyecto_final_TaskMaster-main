document.addEventListener('DOMContentLoaded', function () {
    var tabs = document.querySelectorAll('.tabs h3 a');
    
    tabs.forEach(function (tab) {
        tab.addEventListener('click', function (event) {
            event.preventDefault();
            
            tabs.forEach(function (t) {
                t.classList.remove('active');
            });
            
            this.classList.add('active');
            
            var tabContentId = this.getAttribute('href');
            var tabContents = document.querySelectorAll('div[id$="tab-content"]');
            
            tabContents.forEach(function (content) {
                content.classList.remove('active');
            });
            
            document.querySelector(tabContentId).classList.add('active');
        });
    });
});
