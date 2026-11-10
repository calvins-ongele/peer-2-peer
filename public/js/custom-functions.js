async function copy(item) {
  try {
    await navigator.clipboard.writeText(item);
    console.log(`"${item}" copied to cliboard.`);
    showToast(`"${item}" copied to cliboard.` );
  } catch (error) {
    fallbackCopyTextToClipboard(item);
  }
} 

function fallbackCopyTextToClipboard(text) {
  const textArea = document.createElement("textarea");
  textArea.value = text;
  document.body.appendChild(textArea);
  textArea.select();
  try {
    document.execCommand("copy");
    console.log("Fallback: Copying text command was successful");
  } catch (err) {
    console.error("Fallback: Oops, unable to copy", err);
  }
  document.body.removeChild(textArea);
}

function showToast(text, bg = 'bg-danger') {
 
  const toastLiveExample = document.getElementById("liveToast");
  toastLiveExample.querySelector('.toast-body').innerHTML = text;
  toastLiveExample.classList.add(bg);

  const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample);
  toastBootstrap.show();
 
}

function setCookie(cname, value, days = 30) {
      const date = new Date();
      date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
      const expires = "expires=" + date.toUTCString();
      document.cookie = `${encodeURIComponent(cname)}=${encodeURIComponent(value)};${expires};path=/;SameSite=Lax`;//;secure
}
