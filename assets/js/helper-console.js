window.consoleStyling = window.consoleStyling || {};

window.consoleStyling.enabledColors = ["darkslategray","orange","red","salmon","forestgreen","green","aquamarine"];
window.consoleStyling.enabledColors.forEach(color => {
  window.consoleStyling[color] = [
    `color: ${color}`,
    'padding: 0',
    'line-height: 1em'
  ].join(';')
});

window.logSettings = {
  enable: true
};

if (!window.logSettings.enable) {
  console.log('%cwindow.logSettings.enable is set to false, not printing debug messages', window.consoleStyling.Salmon);
}
else {
  console.log('%cwindow.logSettings.enable is set to true, printing debug messages', window.consoleStyling.Aquamarine);
}

window.log = (...args)=>{
  if (window.logSettings.enable ?? true)
    console.log(...args);
}