<a href="https://mdngrg.de/">
    <img src="https://user-images.githubusercontent.com/4928098/172920747-345acba4-9a12-4d3a-a566-49b5bbb9016b.png" alt="Mediengarage Logo" title="Mediengarage" align="right" height="75" />
</a>

# PIWIK Consent Manager TYPO3 extension

PIWIK Consent Manager integration in order to make TYPO3 content elements GDPR compliant.

1. [What does it do?](#-what-does-it-do)
1. [Installation](#-installation)
1. [Quick Start](#-quick-start)  

## 🤔 What does it do?

Instead of privacy harming content a placeholder will be displayed to the user:
<img width="700" alt="Bildschirmfoto 2022-06-09 um 21 56 47" src="https://user-images.githubusercontent.com/4928098/172933972-57d0ba1b-1f8a-4dbc-9ee2-48bd5ca143d4.png">


Only when the user gives its consent on the PIWIK Consent Manager the page is reloaded and the actual content will be shown.
<img width="700" alt="Bildschirmfoto 2022-06-09 um 21 57 13" src="https://user-images.githubusercontent.com/4928098/172934095-840e8937-127a-4758-a0a8-051467a952c4.png">

## 📦 Installation

1. Install extension
    - **Composer**

        ```shell
        composer req mediengarage/piwik-consent-manager:~0.1
        ```
    - **Non Composer**

        If you want to install into a non composer TYPO3, using the TER is recommended. You can download and install it directly from the Extension Manager of your TYPO3 instance.

1. Include static template into your root TypoScript template and **click save**:
    <img width="700" alt="include_static_template" src="https://user-images.githubusercontent.com/4928098/172921874-a8821fa0-bd85-4d05-8981-bd0a0353a7e4.png">

1. Navigate to **Configure extensions** from the Settings module under Admin Tools:
    <img width="700" alt="configure_extensions" src="https://user-images.githubusercontent.com/4928098/172928087-8fb64880-2ff8-4c23-86a2-1d833559b113.png">

1. Enter your PIWIK Pro credentials. Check step 5 to see from where to retrieve those values from. Keep them secret!
    <img width="700" alt="extensions settings" src="https://user-images.githubusercontent.com/4928098/172929247-a79a78a3-4868-451d-a51e-3f15a1824089.png">

1. Login to your [PIWIK Pro](https://piwik.pro) account and navigate to Menu -> Administration. Choose your website and click the Installation tab.
    <img width="700" alt="piwik_installation" src="https://user-images.githubusercontent.com/4928098/172931019-5a4e316a-35f7-42a8-9486-54f759fa0a76.png">

## 🚀 Quick Start

Quickstart shows how to embed a YouTube video which is only displayed when a user gives its consent.
A placeholder will be shown if no consent was set or it was declined.

In order to have a basic website for presentation purposes the quick start guide uses https://github.com/benjaminkott/bootstrap_package.
    
1. Create a new content element anywhere on the page and choose YouTube from the new privacy tab:
    <img width="700" alt="new_content_element" src="https://user-images.githubusercontent.com/4928098/172922614-d0fd3aa4-d9df-471f-9dd0-a5f5a57cf79f.png">

1. Paste the embed markup into text area and choose a consent type to which the element should react. React means it will be displayed when the user gives its consent on that type. A placeholder image can be set in the image tab.
    <img width="700" alt="yt_content_element" src="https://user-images.githubusercontent.com/4928098/172923497-a71517cb-1df4-431f-81e6-86b95b08bc70.png">

1. Login to your [PIWIK Pro](https://piwik.pro) account and navigate to Menu -> Tag Manager. Create an asynchronous tag for the chosen consent type (Custom Consent in this example) in order to reload the page when a consent was sent. Don't forget to save and publish (or debug to test on production system).
    ```javascript
    <script>
        location.reload();
    </script>
    ```
    <img width="700" alt="piwik_tag" src="https://user-images.githubusercontent.com/4928098/172932884-75a99252-6263-438a-b7ee-0f29120c2497.png">
