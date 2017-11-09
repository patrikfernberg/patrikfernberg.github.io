var pong = window.pong || {};

window.onload = function(){

  pong.game = (function(){

    var canvas = document.getElementById('canvas');
    var ctx = canvas.getContext('2d');
    var scoreboard = document.getElementById('scoreboard');
    var score = 0, refresh_rate = 10, UpArrow = 38, DownArrow = 40;
    var HEIGHT = 800, WIDTH = 500;
    var player, ai, ball, keystate, pi=Math.PI;

    function adjust(){
      canvas.width=800;
      canvas.height=500;
      control.style.display='inline';
    }

  player ={
    x: null,
    y: null,
    width: 20,
    height: 100,

    update: function(){
      if (keystate[UpArrow]) this.y -= 7;
      if (keystate[DownArrow]) this.y += 7;

      this.y = Math.max(Math.min(this.y, 500 - this.height), 0);
      },
    draw: function(){
      ctx.fillRect(this.x, this.y, this.width, this.height);
    }
  };

  ai ={
    x: null,
    y: null,
    width: 20,
    height: 100,

    update: function() {
      var dtn = ball.y - (this.height - ball.side)/2;
      this.y += (dtn - this.y) * 0.05;
    },
    draw: function() {
      ctx.fillRect(this.x, this.y, this.width, this.height);
    }
  };

  ball = {
    x: null,
    y: null,
    vel: null,
    side: 20,
    speed: 10,

    serve: function(side) {
  		// set the x and y position
  		var r = Math.random();
  		this.x = side===1 ? player.x+player.width : ai.x - this.side;
  		this.y = (500 - this.side)*r;
  		// calculate out-angle, higher/lower on the y-axis =>
  		// steeper angle
  		var phi = 0.1*pi*(1 - 2*r);
  		// set velocity direction and magnitude
  		this.vel = {
  			x: side*this.speed*Math.cos(phi),
  			y: this.speed*Math.sin(phi)
  		}
  	},


    update: function() {
      this.x += this.vel.x;
      this.y += this.vel.y;

      if (0 > this.y || this.y+this.side > 500){
        var offset = this.vel.y < 0 ? 0 - this.y : 500 - (this.y+this.side);
        this.y += 2*offset;
        this.vel.y *= -1;
      }

      var Intersect = function(ax, ay, aw, ah, bx, by, bw, bh) {
        return ax < bx+bw && ay < by+bh && bx < ax+aw && by < ay+ah;
      };

      var paddle = this.vel.x < 0 ? player : ai;
      if(Intersect(paddle.x, paddle.y, paddle.width, paddle.height,
        this.x, this.y, this.side, this.side)
      ){
        this.x = paddle===player ? player.width : ai.x - this.side;
        var n = (this.y+this.side - paddle.y)/(paddle.height+this.side);
        var phi = 0.25*pi*(2*n -1);

        var smash = Math.abs(phi) > 0.2*pi ? 1.5 : 1;
        this.vel.x = smash*(paddle===player ? 1 : -1)*this.speed*Math.cos(phi);
        this.vel.y = smash*this.speed*Math.sin(phi);
      }
      if (0 > this.x+this.side){
        score -= 10;
        scoreboard.innerHTML = score;
        this.serve(paddle===player ? 1 : -1);
      }
      if (this.x > 800){
        score += 10;
        scoreboard.innerHTML = score;
        this.serve(paddle===player ? 1 : -1);
      }
    },
    draw: function() {
      ctx.fillRect(this.x, this.y, this.side, this.side);
    }
  };

  function init(){
    player.x = player.width;
    player.y = 200;
    ai.x = 760;
    ai.y = 200;
    ball.serve(1);
  }

  function update(){
    ball.update();
    player.update();
    ai.update();
  }

  function draw(){

    ctx.save();

    ball.draw();
    player.draw();
    ai.draw();
    var w = 4;
    var x = (800 - w)*0.5;
    var y = 0;
    var step = 800/40; // how many net segments
    while (y < 600) {
      ctx.fillRect(x, y+step*0.25, w, step*0.5);
      y += step;
      }
    ctx.restore();
    }

    keystate = {};
    // keep track of keyboard presses
    document.addEventListener("keydown", function(evt) {
      keystate[evt.keyCode] = true;
    });
    document.addEventListener("keyup", function(evt) {
      delete keystate[evt.keyCode];
  });

  init();

  function loop(){
    ctx.fillStyle = "#000";
    ctx.clearRect(0,0,canvas.width,canvas.height);

    update();
    draw();
    pong.game.status = setTimeout(function() { loop(); },refresh_rate);
    }


    function pause(elem){
      if(pong.game.status){
        clearTimeout(pong.game.status);
        pong.game.status=false;
        elem.value='Play'
      }else{
        loop();
      elem.value='Pause';
      }
    }
    function begin(){
      loop();
    }
    function restart(){
      location.reload();
    }
    function start(){
      ctx.fillRect(0,0,canvas.width,canvas.height);
      ctx.fillStyle='#ffffff';
      ctx.font='italic 50px san-serif';
      ctx.fillText('Press here to start',220,260);
      }
      return{
        pause: pause,
        restart : restart,
        start : start,
        begin: begin,
        adjust : adjust,
    };
  })();
  pong.game.start();
}
