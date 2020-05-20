// BLocage des créneaux horaires fermés ou déja réservés
for (var i = 0; i < document.getElementsByClassName('reservation_field').length; i++) {
    if (document.getElementsByClassName('reservation_field')[i].innerHTML == 'close') {
        document.getElementsByClassName('reservation_field')[i].innerHTML = 'fermé';
        document.getElementsByClassName('reservation_field')[i].classList.add('deactivate');
    }
    else if (document.getElementsByClassName('reservation_field')[i].innerHTML == 'reserve') {
        document.getElementsByClassName('reservation_field')[i].innerHTML = 'réservé';
        document.getElementsByClassName('reservation_field')[i].classList.add('deactivate');
    }
    else if (document.getElementsByClassName('reservation_field')[i].innerHTML == 'libre') {
        document.getElementsByClassName('reservation_field')[i].innerHTML = 'non réservé';
    }
}
