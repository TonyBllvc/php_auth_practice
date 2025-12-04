function showForm(showForm, hideForm) {
    // Hidden previous form that was showing
    document.getElementById(hideForm).classList.remove('block');
    document.getElementById(hideForm).classList.add('hidden');
    
    // Show Form newly selected form
    document.getElementById(showForm).classList.remove('hidden')
    document.getElementById(showForm).classList.add('block');

}