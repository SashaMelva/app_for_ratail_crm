var phoneMask = new IMask(
    document.querySelector("#phone"),
    {
        mask: "+{7}(000) 000-00-00",
    });


var priceMask = IMask(
    document.querySelector('#price'),
    {
        mask: '₽num',
        blocks: {
            num: {
                mask: Number,
                thousandsSeparator: ' '
            }
        }
    });