console.log('YTS Loaded...');

var widget_ads = {
    init: function(){
        // alert('widget');
        widget_ads.listenClick();
    },
    listenClick: function(){
        $('.props_item_click').click(function(event){
            event.preventDefault();
            var campaign_id = $(this).attr('campaign-id');
            var ad_id = $(this).attr('ad-id');
            var ad_campaign_id = $(this).attr('ad-campaign-id');

            let data = JSON.stringify({
                ad_campaign_id: ad_campaign_id,
                campaign_id: campaign_id,
                ad_id: ad_id,
            });
            
            widget_ads.registerClick('/register.php', data).then((rest)=>{
                // alert('enviado');
            });
        });
    },
    registerClick: function(url, body){
        var url = 'http://localhost/ams_project/wp-content/plugins/ams'+url;
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