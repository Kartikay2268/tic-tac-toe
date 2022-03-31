let activity = () => {
  req = new XMLHttpRequest();
  req.open('GET','Activity.php')
  req.send(null);
};
activity();
setInterval(activity, 180000);
