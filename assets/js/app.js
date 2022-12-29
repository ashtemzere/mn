// Dom7
var $$ = Dom7;

var app = new Framework7({
    // App root element
    root: '#app',
    // App Name
    name: 'CyrusHub',
    // App id
    id: 'com.myapp.test',
    // Theme
    theme: 'ios',
    // Enable swipe panel
    panel: {
      swipe: 'left',
    },
    // Add default routes
    routes: routes,
    // ... other parameters
  });
  
  var mainView = app.views.create('.view-main', {
    url: '/'
  });