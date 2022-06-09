<a href="https://mdngrg.de/">
    <img src="https://user-images.githubusercontent.com/4928098/172920747-345acba4-9a12-4d3a-a566-49b5bbb9016b.png" alt="Mediengarage Logo" title="Mediengarage" align="right" height="75" />
</a>

# PIWIK Consent Manager TYPO3 extension

GDPR compliant TYPO3 content elements which work great with PIWIK Consent Manager.

## 📦 Installation

- **Composer**

    ```shell
    composer req mediengarage/piwik-consent-manager:~0.1
    ```
- **Non Composer**

    If you want to install into a non composer TYPO3, using the TER is recommended. You can download and install it directly from the Extension Manager of your TYPO3 instance.

1. Include static template into your root TypoScript template and **click save**:
    <img width="700" alt="include_static_template" src="https://user-images.githubusercontent.com/4928098/172921874-a8821fa0-bd85-4d05-8981-bd0a0353a7e4.png">

2. Login to your [PIWIK Pro](https://piwik.pro) account and navigate to MENU -> 

## 🚀 Quick start

Quickstart shows how to embed a YouTube video which is only displayed when a user gives its consent.
A placeholder will be shown if no consent was set or it was declined.

In order to have a basic website for presentation purposes the quick start guide uses https://github.com/benjaminkott/bootstrap_package.
    
1. Create a new content element anywhere on the page and choose YouTube from the new privacy tab:
    <img width="700" alt="new_content_element" src="https://user-images.githubusercontent.com/4928098/172922614-d0fd3aa4-d9df-471f-9dd0-a5f5a57cf79f.png">

2. Paste the embed markup into text area and choose a consent type to which the element should react. React means it will be displayed when the user gives its consent on that type. A placeholder image can be set in the image tab.
    <img width="700" alt="yt_content_element" src="https://user-images.githubusercontent.com/4928098/172923497-a71517cb-1df4-431f-81e6-86b95b08bc70.png">

