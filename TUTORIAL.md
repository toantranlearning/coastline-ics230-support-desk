# TechCorp Customer Portal

<walkthrough-tutorial-duration duration="15"></walkthrough-tutorial-duration>

Welcome to the **TechCorp customer portal**, the internal tool the support desk uses to look up customers and log call notes. You are looking at your own private copy. This guide gets it running and shows you around.

You are signed in to Google, which is what makes this Cloud Shell yours. Nobody else can see or reach this copy, and you do **not** need a credit card or a paid trial for any of it. If a banner ever offers "$300 in free credits," close it.

**First, start the portal.** Click the run icon on the command below:

```bash
bash scripts/start.sh
```

Run this **every time** you open the project, not just the first time. It puts your copy in order, doing only what is still needed:

- keeps exactly **one copy** of the project (removing any extras from a second click on the launch link),
- adds the small **database driver** Cloud Shell needs (the first run takes a few extra seconds for this),
- and starts a fresh **web server** on port 8080. If a server was already running, it restarts it cleanly.

When it says the portal is running on port 8080, you are set. It keeps running in the background, so your terminal stays free for other commands. Click **Next** to see what you are looking at.

## What you are looking at

The screen has three parts:

- <walkthrough-editor-spotlight spotlightId="file-explorer">The file list on the left</walkthrough-editor-spotlight> is every file in the project. Click a file to open it.
- The **editor** in the middle is where you read and change code.
- The black **terminal** across the bottom is where you run commands. It is a free Linux computer that Google runs for you; the terminal is how you talk to it.

Everything you do here stays in your own copy. Nothing you change touches anyone else.

<walkthrough-footnote>Click the launch link only once. If you click it again later, Cloud Shell makes a second copy. That is fine: the start command you just ran removes extra copies and keeps one. Next time, just reopen this Cloud Shell tab.</walkthrough-footnote>

## See the portal

The portal is running inside your Cloud Shell, so you open it through Web Preview. Click <walkthrough-spotlight-pointer spotlightId="devshell-web-preview-button">Web Preview</walkthrough-spotlight-pointer> (top right of the toolbar), then **Preview on port 8080**.

A new tab opens on the TechCorp sign-in page. Only you can open that tab; it is tied to your Google sign-in.

Sign in with the support-rep account:

| Username | Password |
|---|---|
| `rmarsh` | `password` |

You land on the customer list. Look around: the customer list, a customer's account details, the call notes, your profile. This is the internal tool the support desk works in day to day.

<walkthrough-footnote>These are development credentials. Never reuse them anywhere, and never put real data in a development copy.</walkthrough-footnote>

## Change something and see it update

The everyday loop is: change a file, save, reload.

1. Open <walkthrough-editor-select-regex filePath="layout.php" regex='class="brand">TechCorp Portal'>layout.php with the site name selected</walkthrough-editor-select-regex>. That line sets the name shown in the bar at the top of every page.
2. Change `TechCorp Portal` to anything you like and save with **Ctrl-S** (or **Cmd-S** on a Mac).
3. Switch to the portal tab and **reload** it. The top bar shows your new name.

You did not restart anything. The server is already running and reads your files each time the page loads, so saving a file is all it takes.

## Undo a change and reset

To throw a change away, open the <walkthrough-editor-spotlight spotlightId="activity-bar-scm">Source Control</walkthrough-editor-spotlight> panel: it lists every file you changed, and clicking a file shows exactly what changed, old on the left and new on the right. Hover the **Changes** heading and click **Discard All Changes** to put every file back to the original. Reload the portal tab and your change is gone.

That is your undo button. The terminal does the same, and this form goes all the way back to the original copy:

```bash
bash scripts/reset.sh --baseline
```

The portal keeps running through all of these; you never need to stop it to run a command.

**To start completely over.** For a clean slate, run the command below. It removes every copy, fetches a brand-new one, and starts it. It asks you to confirm first, because it throws away all your changes.

```bash
bash scripts/nukeitall.sh
```

If even that will not run, delete every folder in the file list (right-click each folder, **Delete**) and click the launch link again.

## You are set up

You can now run the portal, open it in the browser, change it, and reset it. That is the whole environment.

<walkthrough-footnote>To bring this panel back any time, run `teachme TUTORIAL.md` in the terminal.</walkthrough-footnote>

<walkthrough-conclusion-trophy></walkthrough-conclusion-trophy>
