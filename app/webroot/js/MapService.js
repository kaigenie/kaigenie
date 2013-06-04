/**
 * Created with JetBrains PhpStorm.
 * User: I076004
 * Date: 4/22/13
 * Time: 8:56 PM
 * To change this template use File | Settings | File Templates.
 */
;
(function ($) {

  $.fn.map = function(args) {
    return new MapService(this, args);
  };

  MapService = function(markup, args){
    this.args = {
      width: 500,
      height: 300,
      format: 'json'
    };

    $.extend(this.args, args || {});

    var script = document.createElement("script");
    script.type = "text/javascript";
    script.src = "http://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&sensor=true&callback=initialize";
    document.body.appendChild(script);


  }



  MapService.prototype = {

    log: function() {
      if (!window.console || !$.fn.map.logging) {return;}
      var prepend = "logging: ";
      var args = [prepend];
      args.push.apply(args, arguments);
      console.log.apply(console, args);
    },
    _getProtocol: function(){
      var protocol = document.location.protocol;
      return protocol.substr(protocol.length - 1);
    }
  }

})(jQuery);