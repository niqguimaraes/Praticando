const share = document.getElementById('share')
const shareLinks = document.getElementById('links');
const btnShare = document.getElementById('btn_share');

btnShare.addEventListener('click', () => {
    share.classList.toggle('show');
    shareLinks.classList.toggle('show');
    btnShare.classList.toggle('click');
});
