(function(){
  if (navigator.geolocation) {
    // Trigger the notification
    const form = document.getElementsByTagName('form')[0];
    navigator.geolocation.getCurrentPosition( pt => { Object.defineProperty(window, 'gps', { value: pt } ); form.checkin.removeAttribute('disabled'); } );

    form.addEventListener( 'submit', function(e){
      e.preventDefault();
      const el = document.getElementById('gps');
      if ( ! window.gps ) {
        return false;
      }
      el.value = window.gps.coords.latitude + ',' + window.gps.coords.longitude;
      this.submit();
    } );
  } else {
    alert('لا يمكنك الدحول بدون السماح للموقع بمعرفة مكانك.');
  }
})();
