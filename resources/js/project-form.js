document.addEventListener('DOMContentLoaded', () => {
  const tabsList = document.getElementById('language-tabs');
  const panelsContainer = document.getElementById('tab-panels');
  const panelsTemplate = document.getElementById('panels-template');
  const addTabItem = document.getElementById('add-tab-item');
  const addTabBtn = document.getElementById('add-tab-btn');
  const selectTemplate = document.getElementById('locale-select-template');

  // Show first tab by default
  const firstTab = tabsList.querySelector('.tab-btn');
  if (firstTab) activateTab(firstTab.closest('[data-locale]').dataset.locale);

  // Tab switching
  tabsList.addEventListener('click', (e) => {
    const btn = e.target.closest('.tab-btn');
    if (!btn) return;
    activateTab(btn.closest('[data-locale]').dataset.locale);
  });

  function activateTab(locale) {
    tabsList.querySelectorAll('.tab-btn').forEach((b) => b.classList.remove('active'));
    tabsList.querySelector(`[data-locale="${locale}"] .tab-btn`)?.classList.add('active');

    panelsContainer.querySelectorAll('.tab-panel').forEach((p) => (p.style.display = 'none'));
    panelsContainer.querySelectorAll(`[data-locale="${locale}"]`).forEach((p) => (p.style.display = 'block'));
  }

  // "+" button -> swap to select + confirm
  addTabBtn.addEventListener('click', () => {
    const clone = selectTemplate.content.cloneNode(true);
    addTabItem.innerHTML = '';
    addTabItem.appendChild(clone);

    addTabItem.querySelector('#confirm-add-btn').addEventListener('click', () => {
      const select = addTabItem.querySelector('select');
      const locale = select.value;
      if (!locale) return;

      addLanguageTab(locale);

      // reset "+" button
      addTabItem.innerHTML = '';
      const noneLeft = [...selectTemplate.content.querySelector('select').options].every((opt) => opt.disabled);
      if (noneLeft) return;
      addTabItem.appendChild(addTabBtn);
    });
  });

  function addLanguageTab(locale) {
    // new tab button
    const liClone = tabsList.children[0].cloneNode(true);

    liClone.dataset.locale = locale;
    liClone.querySelector('button.tab-btn').innerText = locale;
    tabsList.insertBefore(liClone, addTabItem);

    // new panels
    [...panelsTemplate.content.children].forEach((ch, ind) => {
      const panelClone = ch.cloneNode(true);
      const label = panelClone.querySelector('label');
      const el = panelClone.querySelector('[name]');

      const name = el.name.replace(/(?<=translations\[)(?=\])/, locale);
      el.name = name;
      el.id = label.htmlFor = name.replace(/\[|\]\[/, '-').replace(/\]/, '');
      panelClone.querySelector('.locale').innerText = locale;
      panelClone.dataset.locale = locale;
      panelClone.style.display = 'none';

      panelsContainer.appendChild(panelClone);
    });

    activateTab(locale);
    selectTemplate.content.querySelectorAll('option').forEach((opt) => {
      if (opt.value === locale) {
        opt.disabled = true;
        return;
      }
    });
  }
});
