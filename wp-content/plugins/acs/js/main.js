console.log('YTS Loaded... new');

var widget_ads = {
    init: function(){
        // alert('widget');
        widget_ads.mount();
        widget_ads.listenClick();
    },
    mount: function(){
        $('main.site-main').append($('.props_wrapper').html());
    },
    listenClick: function(){
        $('.props_item_click').click(function(event){
            event.preventDefault();
            var campaign_id = $(this).attr('campaign-id');
            var ad_id = $(this).attr('ad-id');
            var ad_campaign_id = $(this).attr('ad-campaign-id');
            var href = $(this).attr('href');
            var from = $(this).attr('data-from');

            let data = JSON.stringify({
                ad_campaign_id: ad_campaign_id,
                campaign_id: campaign_id,
                ad_id: ad_id,
            });
            
            widget_ads.registerClick(from,'/register.php', data).then((rest)=>{
                // alert('enviado');
            });
            window.open(href);
        });
    },
    registerClick: function(from, url, body){
        var url = from+'/wp-content/plugins/ams'+url;
        var object = {
            method: 'POST',
            headers: {
              Accept: 'application/json',
              'Content-Type': 'application/json',
            },
            body: body,
        };
        return fetch(url, object).then((res) => res.json());
    }
};

document.addEventListener("DOMContentLoaded", function(event) { 
    widget_ads.init();
});