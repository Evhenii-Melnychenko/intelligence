export function initPostTabs() {
    document.querySelectorAll('[data-post-filters]').forEach((tabList) => {
        const tabs = Array.from(tabList.querySelectorAll('[data-post-filter]'));
        const gridId = tabList.getAttribute('aria-controls');
        const grid = gridId ? document.getElementById(gridId) : tabList.parentElement.querySelector('[data-post-grid]');

        if (tabs.length === 0 || grid === null) {
            return;
        }

        const cards = Array.from(grid.querySelectorAll('[data-post-card]'));
        const emptyState = grid.querySelector('[data-post-empty]');

        const activateTab = (activeTab, moveFocus) => {
            const selectedCategory = activeTab.dataset.postFilter;
            let visibleCards = 0;

            tabs.forEach((tab) => {
                const isActive = tab === activeTab;
                tab.setAttribute('aria-selected', String(isActive));
                tab.setAttribute('tabindex', isActive ? '0' : '-1');

                if (isActive && moveFocus) {
                    tab.focus();
                }
            });

            if (activeTab.id) {
                grid.setAttribute('aria-labelledby', activeTab.id);
            }

            cards.forEach((card) => {
                const categories = (card.dataset.categories || '').split(/\s+/).filter(Boolean);
                const isVisible = selectedCategory === 'all' || categories.includes(selectedCategory);
                card.hidden = !isVisible;

                if (isVisible) {
                    visibleCards += 1;
                }
            });

            if (emptyState) {
                emptyState.hidden = visibleCards !== 0;
            }
        };

        tabs.forEach((tab, index) => {
            tab.addEventListener('click', () => activateTab(tab, false));
            tab.addEventListener('keydown', (event) => {
                let nextIndex = index;

                if (event.key === 'ArrowRight' || event.key === 'ArrowDown') {
                    nextIndex = (index + 1) % tabs.length;
                } else if (event.key === 'ArrowLeft' || event.key === 'ArrowUp') {
                    nextIndex = (index - 1 + tabs.length) % tabs.length;
                } else if (event.key === 'Home') {
                    nextIndex = 0;
                } else if (event.key === 'End') {
                    nextIndex = tabs.length - 1;
                } else {
                    return;
                }

                event.preventDefault();
                activateTab(tabs[nextIndex], true);
            });
        });
    });
}
