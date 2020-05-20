// var currentTab = 0;
// showTab(currentTab);
//
// function showTab(n)
// {
//     var x = document.getElementsByClassName("tab");
//     x[n].style.display = "block";
//
//     if (n == 0) {
//         document.getElementById("prevBtn").style.display = "none";
//     }
//     else {
//         document.getElementById("prevBtn").style.display = "inline";
//     }
//
//     if (n == (x.length - 1)) {
//         document.getElementById("nextBtn").innerHTML = "Réserver";
//     }
//     else {
//         document.getElementById("nextBtn").innerHTML = "Étape suivante";
//     }
//     fixStepIndicator(n);
// }
//
// function nextPrev(n)
// {
//     var x = document.getElementsByClassName("tab");
//
//     if (n == 1 && !validateForm()) return false;
//
//     x[currentTab].style.display = "none";
//     currentTab = currentTab + n;
//
//     if (currentTab >= x.length) {
//         document.getElementById("regForm").submit();
//         return false;
//     }
//     showTab(currentTab);
// }
//
// function validateForm()
// {
//     var x, i, valid = true;
//     x = document.getElementsByClassName("tab");
//
//     if (valid) {
//         document.getElementsByClassName("step")[currentTab].className += " finish";
//     }
//     return valid;
// }
//
// function fixStepIndicator(n)
// {
//     var i, x = document.getElementsByClassName("step");
//
//     for (i = 0; i < x.length; i++) {
//         x[i].className = x[i].className.replace(" active", "");
//     }
//
//     x[n].className += " active";
// }





// BLocage des créneaux horaires fermés ou déja réservés
for (var i = 0; i < document.getElementsByClassName('reservation_field').length; i++) {
    if (document.getElementsByClassName('reservation_field')[i].innerHTML == 'close') {
        document.getElementsByClassName('reservation_field')[i].innerHTML = 'fermé';
        document.getElementsByClassName('reservation_field')[i].classList.add('deactivate');
    }
    else if (document.getElementsByClassName('reservation_field')[i].innerHTML == 'reserve') {
        document.getElementsByClassName('reservation_field')[i].innerHTML = 'indisponible';
        document.getElementsByClassName('reservation_field')[i].classList.add('deactivate');
    }
}





// Affichage nombre de joueurs
function updateTextRangeInput(value)
{
    document.getElementById('selRange').innerHTML = value;
}



// Choisir un seul pack
function updateReservationPackField(elem)
{
    var a = document.getElementsByClassName('pack');
    for (i = 0; i < a.length; i++) {
        a[i].classList.remove('selected');
    }
    elem.classList.add('selected');
}



// Choisir trois créneaux horaires maximum
function updateReservationCalendarField(elem)
{
    if (elem.classList.contains('selected')) {
        elem.classList.remove('selected');
        elem.innerHTML = 'libre';
        for (var i = 0; i < document.getElementsByClassName('reservation_field').length; i++) {
            document.getElementsByClassName('reservation_field')[i].classList.remove('disabled');
        }
    }
    else {
        elem.classList.add('selected');
        elem.innerHTML = 'choisi';
    }


    if (document.querySelectorAll('label.reservation_field.selected').length >= 3) {

        for (var i = 0; i < document.getElementsByClassName('reservation_field').length; i++) {
            document.getElementsByClassName('reservation_field')[i].classList.add('disabled');
        }
        for (var i = 0; i < document.getElementsByClassName('selected').length; i++) {
            document.getElementsByClassName('selected')[i].classList.remove('disabled');
        }
    }
}
