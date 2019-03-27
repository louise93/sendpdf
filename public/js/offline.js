'use strict';

self.addEventListener('load', function() {
  function updateOnlineStatus(event) {
    if (navigator.onLine) {
      // handle online status

    } else {
      // handle offline status
      alert('offline');
    }
  }

  window.addEventListener('online', updateOnlineStatus);
  window.addEventListener('offline', updateOnlineStatus);
});
