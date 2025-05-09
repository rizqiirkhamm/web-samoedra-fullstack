$(function () {
    // Search
    $(document).on("keydown", (e) => {
        if (e.key === "k" && e.ctrlKey) {
            e.preventDefault();
            $("#search").trigger("focus");
        }
    });

    // Drawer functionality is now handled in sidebar.js
    /*
    // Drawer
    $(document).on("click", ".drawer-btn, .sidebar-toggle-btn", function(e) {
        e.preventDefault();
        e.stopPropagation();

        const layoutWrapper = $(".layout-wrapper");
        const sidebar = $(".sidebar-wrapper");
        const overlay = $(".aside-overlay");

        // Toggle all classes synchronously
        layoutWrapper.toggleClass("active");
        sidebar.toggleClass("active");
        overlay.toggleClass("active");

        // Debug logging
        console.log("Drawer button clicked. Sidebar active:", sidebar.hasClass("active"));
    });

    // Close sidebar when clicking overlay
    $(document).on("click", ".aside-overlay", function(e) {
        e.preventDefault();
        e.stopPropagation();

        $(".layout-wrapper").removeClass("active");
        $(".sidebar-wrapper").removeClass("active");
        $(".aside-overlay").removeClass("active");
    });

    // Drawer key access
    $(document).on("keydown", (e) => {
        if (e.key === "b" && e.ctrlKey) {
            e.preventDefault();
            const layoutWrapper = $(".layout-wrapper");
            const sidebar = $(".sidebar-wrapper");
            const overlay = $(".aside-overlay");

            layoutWrapper.toggleClass("active");
            sidebar.toggleClass("active");
            overlay.toggleClass("active");

            // Debug logging
            console.log("Ctrl+B pressed. Sidebar active:", sidebar.hasClass("active"));
        }
    });
    */
});

// Editor
function QuillIsExists() {
    const editorOne = document.querySelector("#editor");
    const editorTwo = document.querySelector("#editor2");
    var toolbarOptions = [
        [{ header: [1, 2, 3, 4, 5, 6, false] }],
        ["bold", "italic", "underline"],
        [{ list: "ordered" }, { list: "bullet" }],
        ["link", "image"],
    ];
    if (editorOne) {
        var editor = new Quill("#editor", {
            modules: { toolbar: toolbarOptions },
            theme: "snow",
        });
    } else if (editorTwo) {
        let editorTwo = new Quill("#editor2", {
            modules: { toolbar: "#toolbar2" },
            theme: "snow",
        });
    }
}
QuillIsExists();

// Settings Tab
const tabs = document.querySelectorAll(".tab");
const tabContent = document.querySelectorAll(".tab-pane");

tabs.forEach((tab) => {
    tab.addEventListener("click", () => {
        const target = tab.getAttribute("data-tab");

        tabs.forEach((t) => t.classList.remove("active"));
        tab.classList.add("active");

        tabContent.forEach((content) => {
            content.classList.toggle("active", content.getAttribute("id") === target);
        });
    });
});

// Faq
const accordionHeader = document.querySelectorAll(".accordion-header");
accordionHeader.forEach((header) => {
    header.addEventListener("click", function () {
        const accordionContent = header.parentElement.querySelector(".accordion-content");
        let accordionMaxHeight = accordionContent.style.maxHeight;

        if (accordionMaxHeight === "0px" || !accordionMaxHeight) {
            accordionContent.style.maxHeight = `${accordionContent.scrollHeight + 32}px`;
            header.querySelector(".fas").classList.replace("fa-plus", "fa-minus");
            header.querySelector(".title").classList.add("font-bold");
        } else {
            accordionContent.style.maxHeight = "0px";
            header.querySelector(".fas").classList.replace("fa-minus", "fa-plus");
            header.querySelector(".title").classList.remove("font-bold");
        }
    });
});

// Other functions
function notificationAction() {
    $("#notification-box").toggle();
    $("#noti-outside").toggle();
}

function messageAction() {
    $("#message-box").toggle();
    $("#mes-outside").toggle();
}

function storeAction() {
    $("#store-box").toggle();
    $("#store-outside").toggle();
}

function profileAction() {
    $(".profile-box").toggle();
    $(".profile-outside").toggle();
}

function toggleSettings() {
    $("#profile-settings").toggle();
}

function dateFilterAction(selector) {
    $(selector).toggle();
}

// Multi Step Modal
function ModalExist() {
    const modalContent = document.querySelector(".modal-content");
    if (modalContent) {
        const modal = document.getElementById("multi-step-modal");
        const stepContents = modalContent.querySelectorAll(".step-content");
        const nextButtons = modalContent.querySelectorAll('[id$="-next"]');
        const cancelButtons = modalContent.querySelectorAll('[id$="-cancel"]');
        const modalOpen = document.querySelector(".modal-open");
        const modalOverlay = document.querySelector(".modal-overlay");

        modalOpen.addEventListener("click", () => modal.classList.remove("hidden"));

        function hideModal() {
            modal.classList.add("hidden");
        }

        modalOverlay.addEventListener("click", hideModal);

        let currentStep = 1;

        function showStep(step) {
            stepContents.forEach((stepContent) => stepContent.classList.add("hidden"));
            modalContent.querySelector(`.step-${step}`).classList.remove("hidden");
        }

        function setCurrentStep(step) {
            currentStep = step;
            showStep(currentStep);
        }

        cancelButtons.forEach((cancelButton) => {
            cancelButton.addEventListener("click", hideModal);
        });

        nextButtons.forEach((nextButton) => {
            nextButton.addEventListener("click", () => setCurrentStep(currentStep + 1));
        });

        setCurrentStep(1);
    }
}
ModalExist();

// Switch Toggle
const switch_btn = document.querySelectorAll(".switch-btn");
switch_btn.forEach((item) => {
    item.addEventListener("click", () => {
        item.classList.toggle("active");
    });
});

// Navigation Submenu
function navSubmenu() {
    const navSelector = document.querySelector(".nav-wrapper");
    if (navSelector) {
        const navItems = navSelector.querySelectorAll(".item");
        navItems.forEach((item) => {
            const submenuExist = item.querySelector(".sub-menu");
            if (submenuExist) {
                const clickItem = item.querySelector("a");
                clickItem.addEventListener("click", (e) => {
                    e.preventDefault();
                    submenuExist.classList.toggle("active");
                });
            }
        });
    }
}
navSubmenu();

// Theme Toggle
if (localStorage.getItem('darkMode') === 'true' || (!localStorage.getItem('darkMode') && window.matchMedia("(prefers-color-scheme: dark)").matches)) {
    document.documentElement.classList.add("dark");
} else {
    document.documentElement.classList.remove("dark");
}

document.getElementById("theme-toggle")?.addEventListener("click", function () {
    const isDark = document.documentElement.classList.toggle("dark");
    localStorage.setItem('darkMode', isDark);
});