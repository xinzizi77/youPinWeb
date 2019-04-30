window.onload = function(){
    var cityPicker = new HzwCityPicker({
        data: data,
        target: 'chengshi',
        valType: 'k-v',
        hideCityInput: {
            name: 'city',
            id: 'city'
        },
        hideProvinceInput: {
            name: 'province',
            id: 'province'
        },
        // callback: function(){
        //     alert('OK');
        // }
    });

    cityPicker.init();
}