document.addEventListener('DOMContentLoaded', () => {
  const buttons = document.querySelector('.btn-group').children;
  const t10ns = document.querySelectorAll('.locale-container');
  console.log([...buttons]);

  [...buttons].forEach((btn) =>
    btn.addEventListener('click', (e) => {
      const pressedBtn = e.currentTarget;

      [...buttons].find((btn) => btn.className.includes('active')).classList.remove('active');
      pressedBtn.className += ' active';

      [...t10ns].forEach((container) => {
        if (container.dataset.locale == pressedBtn.innerText) container.classList.remove('d-none');
        else container.classList.add('d-none');
      });
    }),
  );
});
