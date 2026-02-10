

document.addEventListener('DOMContentLoaded', function () {
    // ===========================================
    // Load More Logic
    // ===========================================
    const loadMoreBtn = document.getElementById('loadMoreBtn');
    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', function (e) {
            e.preventDefault();

            // Find all hidden items that are waiting to be loaded
            const hiddenItems = document.querySelectorAll('.to-be-loaded.d-none');

            // Show next 6 items
            let count = 0;
            // Convert NodeList to Array to safely slice or just iterate
            for (let i = 0; i < hiddenItems.length; i++) {
                if (count >= 6) break;

                const item = hiddenItems[i];
                item.classList.remove('d-none');
                item.classList.remove('to-be-loaded'); // Mark as loaded

                // Simple fade in effect
                item.style.opacity = '0';
                item.animate([
                    { opacity: 0, transform: 'translateY(20px)' },
                    { opacity: 1, transform: 'translateY(0)' }
                ], {
                    duration: 500,
                    easing: 'ease-out',
                    fill: 'forwards'
                });

                count++;
            }

            // Re-check remaining count
            const remaining = document.querySelectorAll('.to-be-loaded.d-none').length;
            if (remaining === 0) {
                this.parentElement.style.display = 'none'; // Hide container
            }
        });
    }

    // ===========================================
    // Filter Interaction Logic (Dynamic)
    // ===========================================

    // Sub-Category Mapping (Dynamic from PHP)
    const subCategoryMap = window.subCategoriesMap || {};

    // DOM Elements
    // Note: My PHP adds 'btn-check' to dynamic filters.
    // Selector needs to exclude sub-category checks which are added dynamically


    const items = document.querySelectorAll('.filter-item');
    const interceptorCard = document.querySelector('.interceptor-card');

    const clearFiltersBtn = document.getElementById('clearFiltersBtn');
    const subCategoryRow = document.getElementById('subCategoryRow');
    const subCategoryLabel = document.getElementById('subCategoryLabel');
    const subCategoryPills = document.getElementById('subCategoryPills');

    // Sub-Category Row Management
    function showSubCategories(categorySlug) {
        const subCategories = subCategoryMap[categorySlug];

        // If no subcategories, just hide the row
        if (!subCategories || subCategories.length === 0) {
            hideSubCategories();
            return;
        }

        // Update label
        if (subCategoryLabel) {
            subCategoryLabel.textContent = (categorySlug.charAt(0).toUpperCase() + categorySlug.slice(1)).replace(/-/g, ' ');
        }

        // Build sub-category pills
        // PHP sends: { slug: '...', name: '...' }
        // We generate data-filter-value=".cat-slug" to match PHP class logic
        if (subCategoryPills) {
            subCategoryPills.innerHTML = subCategories.map(sub => `
                <input type="checkbox" class="btn-check sub-category-check" id="sub-${sub.slug}" autocomplete="off" data-filter-value=".cat-${sub.slug}">
                <label class="btn btn-sm btn-outline-secondary" for="sub-${sub.slug}">${sub.name}</label>
            `).join('');

            // Attach event listeners to new sub-category checkboxes
            subCategoryPills.querySelectorAll('.sub-category-check').forEach(cb => {
                cb.addEventListener('change', applyFilters);
            });
        }

        // Show with animation
        if (subCategoryRow) {
            subCategoryRow.style.display = 'flex';
            subCategoryRow.animate([
                { opacity: 0, maxHeight: '0px' },
                { opacity: 1, maxHeight: '100px' }
            ], {
                duration: 250,
                easing: 'ease-out',
                fill: 'forwards'
            });
        }
    }

    function hideSubCategories() {
        if (subCategoryRow && subCategoryRow.style.display !== 'none') {
            subCategoryRow.animate([
                { opacity: 1, maxHeight: '100px' },
                { opacity: 0, maxHeight: '0px' }
            ], {
                duration: 200,
                easing: 'ease-in',
                fill: 'forwards'
            }).onfinish = () => {
                subCategoryRow.style.display = 'none';
                if (subCategoryPills) subCategoryPills.innerHTML = '';
            };
        }
    }

    // Get Active Filters (Both Levels)
    function getActiveFilters() {
        const active = [];
        // Level 1 & Other filters
        document.querySelectorAll('.filter-pills .btn-check:checked').forEach(cb => {
            const val = cb.getAttribute('data-filter-value');
            if (val) active.push(val);
        });
        return active;
    }

    // Main Filter Function
    function applyFilters() {
        const activeFilters = getActiveFilters();
        const isFiltering = activeFilters.length > 0;
        let visibleCount = 0;

        // Toggle Clear Button
        if (clearFiltersBtn) {
            if (isFiltering) clearFiltersBtn.classList.remove('d-none');
            else clearFiltersBtn.classList.add('d-none');
        }

        // Handle Load More Button
        if (loadMoreBtn) {
            if (isFiltering) loadMoreBtn.classList.add('d-none');
            // Logic to show it back is complex with WP Query, omit for now or leave hidden
        }

        items.forEach(item => {
            // The item has multiple classes like "col filter-item vol-30ml cat-face"
            // We check if it has ALL required classes

            const matches = activeFilters.every(filter => {
                // filter is like ".vol-30ml"
                // we check if item.classList contains "vol-30ml"
                const className = filter.substring(1); // remove dot
                return item.classList.contains(className);
            });

            if (isFiltering) {
                // Ensure it's not hidden by 'd-none' from initial state
                item.classList.remove('d-none');

                if (matches) {
                    item.style.display = 'block';
                    // Simple fade in
                    item.style.opacity = '1';
                    visibleCount++;
                } else {
                    item.style.display = 'none';
                }
            } else {
                // Reset
                item.style.display = '';
                // If it was hidden initially (more-designs), keep it hidden?
                // The dynamic WP Query loads 12 posts. They are all visible.
                // So we just reset to block.
                visibleCount++;
            }
        });

        // Handle "No Results" State
        const noResults = document.getElementById('js-no-results');
        if (noResults) {
            if (visibleCount === 0) {
                noResults.classList.remove('d-none');
            } else {
                noResults.classList.add('d-none');
            }
        }

        // Handle Interceptor Card: Hide if no products are visible
        if (interceptorCard) {
            if (visibleCount === 0) {
                interceptorCard.classList.add('d-none');
            } else {
                interceptorCard.classList.remove('d-none');
            }
        }
    }

    // Category Checkbox Event Listeners
    // Use event delegation or attach to existing static checkboxes
    // The static checkboxes are those rendered by PHP on load

    document.querySelectorAll('.filter-pills .btn-check').forEach(cb => {
        cb.addEventListener('change', function () {
            // Check if this is a Parent Category Trigger
            const isParentCat = this.classList.contains('parent-cat-trigger');
            const termSlug = this.getAttribute('data-term-slug');
            const filterValue = this.getAttribute('data-filter-value');

            // Interaction: Parent Category Clicked
            if (isParentCat) {
                if (this.checked) {
                    // Radio behavior: Uncheck other parents
                    document.querySelectorAll('.parent-cat-trigger').forEach(other => {
                        if (other !== this && other.checked) {
                            other.checked = false;
                        }
                    });

                    // Uncheck "YUSU Originals" if user clicks a category?
                    // Let's assume yes
                    /*
                    const yusuCb = document.querySelector('.yusu-original-trigger');
                    if(yusuCb && yusuCb.checked) yusuCb.checked = false;
                    */

                    showSubCategories(termSlug);
                } else {
                    hideSubCategories();
                }
            } else {
                // If checking "YUSU Originals" or other special toggles, 
                // we might want to uncheck categories? 
                // For now, allow combination or simple toggle.

                // If "YUSU Originals" (assuming class or data attribute) is clicked, clear sub-cats
                if (this.classList.contains('yusu-original-trigger')) {
                    if (this.checked) {
                        document.querySelectorAll('.parent-cat-trigger').forEach(c => c.checked = false);
                        hideSubCategories();
                    }
                }
            }

            applyFilters();
        });
    });

    // Clear All Filters
    if (clearFiltersBtn) {
        clearFiltersBtn.addEventListener('click', function () {
            document.querySelectorAll('.btn-check').forEach(cb => cb.checked = false);
            hideSubCategories();
            applyFilters();
        });
    }

    // ===========================================
    // Animation Observer (Industrial Precision)
    // ===========================================
    const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.1 // Trigger early for smooth feeling
    };

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target); // Run once
            }
        });
    }, observerOptions);

    document.querySelectorAll('.animate-on-scroll').forEach(el => {
        observer.observe(el);
    });


    // ===========================================
    // URL Parameter: Auto-Filter on Load
    // ===========================================
    const urlParams = new URLSearchParams(window.location.search);
    const categoryParam = urlParams.get('category');

    if (categoryParam) {
        // 1. Open the filter collapse
        const filterCollapse = document.getElementById('filterCollapse');
        if (filterCollapse) {
            const bsCollapse = new bootstrap.Collapse(filterCollapse, { toggle: false });
            bsCollapse.show();

            // Update toggle button aria state
            const toggleBtn = document.querySelector('[data-bs-target="#filterCollapse"]');
            if (toggleBtn) {
                toggleBtn.setAttribute('aria-expanded', 'true');
            }
        }

        // 2. Find and check the matching category filter
        const targetCheckbox = document.getElementById('cat-' + categoryParam);
        if (targetCheckbox) {
            targetCheckbox.checked = true;

            // If it's a parent category, also show sub-categories
            if (targetCheckbox.classList.contains('parent-cat-trigger')) {
                const termSlug = targetCheckbox.getAttribute('data-term-slug');
                if (termSlug) {
                    showSubCategories(termSlug);
                }
            }

            // Apply filters to show only matching products
            applyFilters();
        }

        // 3. Scroll to the filter bar after collapse animation completes
        setTimeout(() => {
            const filterBar = document.querySelector('.filter-bar');
            if (filterBar) {
                filterBar.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        }, 400);
    }
});
