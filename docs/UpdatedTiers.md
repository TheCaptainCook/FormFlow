# FormFlow - Complete Node Reference (Biased toward Lifetime)

## 🎯 The Honest Truth

| Tier | Price | Philosophy | Support |
|------|-------|------------|---------|
| 🟢 **Free** | $0 | "Just enough to frustrate you into upgrading" | None |
| 🔵 **Pro** | $29.99/month | "You're serious, but not serious enough" | Email (48h) |
| 🟠 **Business** | $69.99/month | "Almost everything... but not quite" | Priority (24h) |
| 💎 **Lifetime** | $699.99 one-time | **"Everything. Forever. No subscription."** | Instant + VIP |

---

## LEGEND
- 🟢 **Free** - 15 nodes. Good luck.
- 🔵 **Pro** - 60 nodes. Getting there.
- 🟠 **Business** - 120 nodes. So close.
- 💎 **Lifetime** - **ALL 262 nodes. No limits. Forever.**

---

## 1. Trigger / Entry Nodes
*What starts your automation. The "when" of FormFlow.*

| Node | Functionality | Free | Pro | Business | Lifetime |
|------|---------------|------|-----|----------|----------|
| `onPageLoad` | Fires when the form page finishes loading in a browser. | ✅ | ✅ | ✅ | 💎 |
| `onButtonClick` | Triggers when a specific button is clicked by the user. | ✅ | ✅ | ✅ | 💎 |
| `onFormSubmit` | Activates when the form is submitted (standard POST/GET). | ✅ | ✅ | ✅ | 💎 |
| `onFieldChange` | Triggers instantly when a user modifies a field's value. | ❌ | ✅ | ✅ | 💎 |
| `onTimer` | Fires at a specified interval (e.g., every 5 seconds). | ❌ | ❌ | ✅ | 💎 |
| `onScroll` | Activates when a user scrolls to a specific element or depth. | ❌ | ❌ | ❌ | 💎 |
| `onWebhookReceive` | Listens for external HTTP requests (webhooks) to trigger flows. | ❌ | ❌ | ❌ | 💎 |
| `onSchedule` | Triggers at a specific date/time or recurring cron schedule. | ❌ | ❌ | ❌ | 💎 |

---

## 2. Input / Field Nodes
*What you use to collect data. Each field is a different data type.*

| Node | Functionality | Free | Pro | Business | Lifetime |
|------|---------------|------|-----|----------|----------|
| `textField` | Single-line text input. Good for names, subjects. | ✅ | ✅ | ✅ | 💎 |
| `emailField` | Email input with built-in validation for format. | ✅ | ✅ | ✅ | 💎 |
| `telField` | Telephone number input (triggers numeric keypad on mobile). | ❌ | ✅ | ✅ | 💎 |
| `textareaField` | Multi-line text input for longer messages. | ✅ | ✅ | ✅ | 💎 |
| `numberField` | Numeric input with min/max step controls. | ❌ | ✅ | ✅ | 💎 |
| `selectField` | Dropdown menu for selecting one option from many. | ❌ | ✅ | ✅ | 💎 |
| `checkboxField` | Boolean toggle (true/false). One or multiple selections. | ✅ | ✅ | ✅ | 💎 |
| `radioGroup` | Select exactly one option from a predefined group. | ❌ | ✅ | ✅ | 💎 |
| `dateField` | Date picker (YYYY-MM-DD). | ❌ | ❌ | ✅ | 💎 |
| `timeField` | Time picker (HH:MM). | ❌ | ❌ | ✅ | 💎 |
| `datetimeField` | Combined date + time picker. | ❌ | ❌ | ❌ | 💎 |
| `fileUpload` | Allows users to upload files (images, docs, etc). | ❌ | ✅ | ✅ | 💎 |
| `urlField` | Website URL input with format validation. | ❌ | ✅ | ✅ | 💎 |
| `passwordField` | Masked text input for passwords. | ✅ | ✅ | ✅ | 💎 |
| `rangeSlider` | Drag-to-select a numeric value within a range. | ❌ | ❌ | ❌ | 💎 |
| `colorPicker` | Visual color selection (returns HEX value). | ❌ | ❌ | ❌ | 💎 |
| `hiddenField` | Stores data without showing anything to the user. | ❌ | ✅ | ✅ | 💎 |
| `signaturePad` | Canvas-based signature capture. | ❌ | ❌ | ❌ | 💎 |
| `ratingStars` | 1-5 star rating input. | ❌ | ❌ | ❌ | 💎 |
| `otpInput` | One-time password input with auto-advance. | ❌ | ❌ | ❌ | 💎 |
| `addressAutocomplete` | Google Maps-powered address lookup. | ❌ | ❌ | ❌ | 💎 |

---

## 3. Validation Nodes
*Ensures data is correct before processing. Your gatekeeper.*

| Node | Functionality | Free | Pro | Business | Lifetime |
|------|---------------|------|-----|----------|----------|
| `validateRequired` | Checks if a field has a value (not empty). | ✅ | ✅ | ✅ | 💎 |
| `validateEmail` | Checks if the input matches email@domain.com format. | ✅ | ✅ | ✅ | 💎 |
| `validateRegex` | Checks input against a custom regular expression. | ❌ | ✅ | ✅ | 💎 |
| `validateMinLength` | Ensures text is longer than X characters. | ✅ | ✅ | ✅ | 💎 |
| `validateMaxLength` | Ensures text is shorter than X characters. | ✅ | ✅ | ✅ | 💎 |
| `validateMinValue` | Ensures a number is greater than or equal to X. | ❌ | ✅ | ✅ | 💎 |
| `validateMaxValue` | Ensures a number is less than or equal to X. | ❌ | ✅ | ✅ | 💎 |
| `validateMatch` | Checks if two fields have identical values (e.g., passwords). | ❌ | ✅ | ✅ | 💎 |
| `validateUnique` | Checks if a value already exists in the database. | ❌ | ❌ | ✅ | 💎 |
| `validateFileType` | Restricts uploaded file types (e.g., only PDF). | ❌ | ❌ | ✅ | 💎 |
| `validateFileSize` | Restricts uploaded file size (e.g., max 5MB). | ❌ | ❌ | ✅ | 💎 |
| `validateDateRange` | Ensures a date falls between two others. | ❌ | ❌ | ❌ | 💎 |
| `validateAge` | Ensures the user is at least X years old. | ❌ | ❌ | ❌ | 💎 |
| `validateCreditCard` | Checks if a number could be a valid credit card (Luhn algo). | ❌ | ❌ | ❌ | 💎 |
| `validatePostalCode` | Checks format against country-specific postal codes. | ❌ | ❌ | ❌ | 💎 |
| `validateVAT` | Checks European VAT number format. | ❌ | ❌ | ❌ | 💎 |
| `validateIBAN` | Checks international bank account number format. | ❌ | ❌ | ❌ | 💎 |

---

## 4. Spam Protection Nodes
*Keeps the bots out so your data stays clean.*

| Node | Functionality | Free | Pro | Business | Lifetime |
|------|---------------|------|-----|----------|----------|
| `honeypot` | Hidden trap field that bots fill out (humans don't see it). | ✅ | ✅ | ✅ | 💎 |
| `rateLimiter` | Limits submissions from the same IP in a time window. | ❌ | ✅ | ✅ | 💎 |
| `recaptcha` | Google's "I'm not a robot" checkbox or challenge. | ❌ | ❌ | ✅ | 💎 |
| `turnstile` | Cloudflare's invisible, non-intrusive CAPTCHA alternative. | ❌ | ❌ | ✅ | 💎 |
| `hcaptcha` | Privacy-focused CAPTCHA alternative. | ❌ | ❌ | ❌ | 💎 |
| `blocklistEmail` | Rejects submissions from known spam email domains. | ❌ | ❌ | ❌ | 💎 |
| `blocklistIP` | Blocks specific IP addresses from submitting. | ❌ | ❌ | ❌ | 💎 |
| `blocklistKeyword` | Blocks submissions containing specific blacklisted words. | ❌ | ❌ | ❌ | 💎 |
| `timeTrap` | Rejects forms submitted faster than a human could (e.g., <2 seconds). | ✅ | ✅ | ✅ | 💎 |
| `fingerprint` | Creates a browser fingerprint to detect multiple accounts. | ❌ | ❌ | ❌ | 💎 |

---

## 5. Logic & Flow Control Nodes
*Directs traffic. Decides what happens next, and when.*

| Node | Functionality | Free | Pro | Business | Lifetime |
|------|---------------|------|-----|----------|----------|
| `condition` | If/Then/Else branching based on data or variables. | ✅ | ✅ | ✅ | 💎 |
| `switch` | Multi-case branching (like Switch/Case in coding). | ❌ | ✅ | ✅ | 💎 |
| `merge` | Brings two parallel execution paths back together. | ❌ | ✅ | ✅ | 💎 |
| `delay` | Pauses execution for a set number of seconds. | ❌ | ✅ | ✅ | 💎 |
| `loop` | Repeats a block of nodes a specified number of times. | ❌ | ❌ | ✅ | 💎 |
| `break` | Immediately exits a loop. | ❌ | ❌ | ✅ | 💎 |
| `continue` | Skips to the next iteration of a loop. | ❌ | ❌ | ✅ | 💎 |
| `terminate` | Ends the entire flow immediately. | ✅ | ✅ | ✅ | 💎 |
| `fork` | Splits execution into multiple simultaneous paths. | ❌ | ❌ | ❌ | 💎 |
| `join` | Waits for all parallel forks to finish before continuing. | ❌ | ❌ | ❌ | 💎 |
| `retry` | Re-executes a failed step up to X times. | ❌ | ❌ | ❌ | 💎 |
| `circuitBreaker` | Stops repeated calls to a failing service temporarily. | ❌ | ❌ | ❌ | 💎 |

---

## 6. Data Transformation Nodes
*Changes the shape, format, or type of your data.*

| Node | Functionality | Free | Pro | Business | Lifetime |
|------|---------------|------|-----|----------|----------|
| `trim` | Removes leading/trailing whitespace from text. | ✅ | ✅ | ✅ | 💎 |
| `lowercase` | Converts all letters to lowercase. | ✅ | ✅ | ✅ | 💎 |
| `uppercase` | Converts all letters to uppercase. | ✅ | ✅ | ✅ | 💎 |
| `capitalize` | Capitalizes the first letter of each word. | ❌ | ✅ | ✅ | 💎 |
| `sanitizeHtml` | Strips HTML tags and dangerous code from input. | ❌ | ✅ | ✅ | 💎 |
| `escape` | Converts special characters to HTML entities. | ❌ | ✅ | ✅ | 💎 |
| `slugify` | Converts text to a URL-safe string (e.g., "Hello World" -> "hello-world"). | ❌ | ❌ | ✅ | 💎 |
| `truncate` | Cuts text to a max length and adds "...". | ✅ | ✅ | ✅ | 💎 |
| `formatPhone` | Converts phone numbers to a standard format. | ❌ | ❌ | ✅ | 💎 |
| `formatDate` | Converts dates between formats (e.g., YYYY-MM-DD to MM/DD/YYYY). | ❌ | ❌ | ✅ | 💎 |
| `concat` | Joins two or more text strings together. | ✅ | ✅ | ✅ | 💎 |
| `split` | Divides text into an array based on a delimiter. | ❌ | ✅ | ✅ | 💎 |
| `replace` | Finds and replaces text (supports regex). | ❌ | ✅ | ✅ | 💎 |
| `extract` | Pulls a substring using start/end positions. | ❌ | ❌ | ❌ | 💎 |
| `jsonParse` | Converts a JSON string into an object/variable. | ✅ | ✅ | ✅ | 💎 |
| `jsonStringify` | Converts a variable/object into a JSON string. | ✅ | ✅ | ✅ | 💎 |
| `base64Encode` | Encodes text to Base64 format. | ❌ | ✅ | ✅ | 💎 |
| `base64Decode` | Decodes Base64 back to plain text. | ❌ | ✅ | ✅ | 💎 |
| `hash` | Creates a hash (SHA256, MD5) of text. | ❌ | ❌ | ✅ | 💎 |
| `encrypt` | Encrypts data using AES-256. | ❌ | ❌ | ❌ | 💎 |
| `decrypt` | Decrypts data previously encrypted. | ❌ | ❌ | ❌ | 💎 |
| `maskPII` | Redacts sensitive data (e.g., "john@doe.com" -> "j***@d**e.com"). | ❌ | ❌ | ❌ | 💎 |

---

## 7. Variable Nodes
*Memory for your flow. Store, retrieve, and manage data.*

| Node | Functionality | Free | Pro | Business | Lifetime |
|------|---------------|------|-----|----------|----------|
| `setVariable` | Creates or updates a variable with a value. | ✅ | ✅ | ✅ | 💎 |
| `getVariable` | Retrieves a previously stored variable's value. | ✅ | ✅ | ✅ | 💎 |
| `increment` | Adds 1 to a numeric variable. | ❌ | ✅ | ✅ | 💎 |
| `decrement` | Subtracts 1 from a numeric variable. | ❌ | ✅ | ✅ | 💎 |
| `variableExists` | Checks if a variable has been defined. | ❌ | ✅ | ✅ | 💎 |
| `clearVariable` | Deletes a variable, freeing its memory. | ❌ | ✅ | ✅ | 💎 |
| `sessionGet` | Gets a value from browser session storage (clears on tab close). | ✅ | ✅ | ✅ | 💎 |
| `sessionSet` | Saves a value to browser session storage. | ✅ | ✅ | ✅ | 💎 |
| `localGet` | Gets a value from browser local storage (persists forever). | ✅ | ✅ | ✅ | 💎 |
| `localSet` | Saves a value to browser local storage. | ✅ | ✅ | ✅ | 💎 |
| `cookieGet` | Reads a browser cookie value. | ❌ | ❌ | ✅ | 💎 |
| `cookieSet` | Writes a browser cookie with optional expiry. | ❌ | ❌ | ✅ | 💎 |
| `globalVariable` | Cross-user variable (shared across all sessions). | ❌ | ❌ | ❌ | 💎 |
| `redisVariable` | High-performance, persistent cross-session variable using Redis. | ❌ | ❌ | ❌ | 💎 |

---

## 8. Action / Destination Nodes
*Where the data goes. Your final destinations.*

| Node | Functionality | Free | Pro | Business | Lifetime |
|------|---------------|------|-----|----------|----------|
| `sendEmail` | Sends a transactional email (SMTP or API). | ❌ | ✅ | ✅ | 💎 |
| `sendEmailBatch` | Sends an email to multiple recipients at once. | ❌ | ❌ | ✅ | 💎 |
| `saveDatabase` | Inserts a new record into a connected database. | ❌ | ❌ | ✅ | 💎 |
| `updateDatabase` | Updates existing records in a database. | ❌ | ❌ | ✅ | 💎 |
| `webhook` | Sends data to any URL via POST request (JSON form). | ✅ | ✅ | ✅ | 💎 |
| `webhookGet` | Sends data via GET request (query parameters). | ✅ | ✅ | ✅ | 💎 |
| `redirect` | Sends the user's browser to a different URL. | ✅ | ✅ | ✅ | 💎 |
| `downloadFile` | Forces a file download from a URL to the user's device. | ❌ | ❌ | ✅ | 💎 |
| `print` | Opens the browser's print dialog for the current page. | ❌ | ✅ | ✅ | 💎 |
| `copyToClipboard` | Copies text to the user's system clipboard. | ❌ | ✅ | ✅ | 💎 |
| `webhookSigned` | Sends a webhook with HMAC signature for security. | ❌ | ❌ | ❌ | 💎 |
| `queueMessage` | Adds a message to a queue system (RabbitMQ, SQS). | ❌ | ❌ | ❌ | 💎 |
| `webSocket` | Pushes live data to connected clients over WebSocket. | ❌ | ❌ | ❌ | 💎 |

---

## 9. Notification Nodes
*Alert you or your team. Real-time communication.*

| Node | Functionality | Free | Pro | Business | Lifetime |
|------|---------------|------|-----|----------|----------|
| `slack` | Sends a message to a Slack channel via webhook. | ❌ | ✅ | ✅ | 💎 |
| `discord` | Sends a message to a Discord channel via webhook. | ❌ | ✅ | ✅ | 💎 |
| `telegram` | Sends a message to a Telegram chat via bot. | ❌ | ❌ | ✅ | 💎 |
| `teams` | Sends a message to a Microsoft Teams channel. | ❌ | ❌ | ❌ | 💎 |
| `sms` | Sends an SMS text message via Twilio or similar. | ❌ | ❌ | ❌ | 💎 |
| `pushbullet` | Sends a notification to Pushbullet-connected devices. | ❌ | ❌ | ❌ | 💎 |
| `webPush` | Sends a browser push notification (requires HTTPS). | ❌ | ❌ | ❌ | 💎 |
| `emailAutoResponder` | Sends an automatic email reply to the form submitter. | ❌ | ✅ | ✅ | 💎 |
| `whatsapp` | Sends a WhatsApp message via WhatsApp Business API. | ❌ | ❌ | ❌ | 💎 |
| `pushover` | Sends a high-priority push notification via Pushover. | ❌ | ❌ | ❌ | 💎 |

---

## 10. Storage Nodes (File/Cloud)
*Store files, not just data.*

| Node | Functionality | Free | Pro | Business | Lifetime |
|------|---------------|------|-----|----------|----------|
| `saveFileLocal` | Saves an uploaded file to the server's filesystem. | ❌ | ✅ | ✅ | 💎 |
| `uploadS3` | Uploads a file to Amazon S3 (or compatible) bucket. | ❌ | ❌ | ✅ | 💎 |
| `uploadGCS` | Uploads a file to Google Cloud Storage bucket. | ❌ | ❌ | ✅ | 💎 |
| `uploadAzure` | Uploads a file to Azure Blob Storage. | ❌ | ❌ | ✅ | 💎 |
| `uploadDropbox` | Uploads a file to Dropbox. | ❌ | ❌ | ❌ | 💎 |
| `uploadFTP` | Uploads a file to an FTP/SFTP server. | ❌ | ❌ | ❌ | 💎 |
| `deleteFile` | Removes a file from cloud or local storage. | ❌ | ❌ | ✅ | 💎 |
| `streamingUpload` | Uploads large files in chunks (good for >100MB). | ❌ | ❌ | ❌ | 💎 |

---

## 11. UI/UX Nodes
*Controls what the user sees and experiences on the frontend.*

| Node | Functionality | Free | Pro | Business | Lifetime |
|------|---------------|------|-----|----------|----------|
| `showSuccess` | Displays a green success message (banner or toast). | ✅ | ✅ | ✅ | 💎 |
| `showError` | Displays a red error message. | ✅ | ✅ | ✅ | 💎 |
| `showWarning` | Displays a yellow warning message. | ❌ | ✅ | ✅ | 💎 |
| `showLoading` | Shows a loading spinner overlay. | ✅ | ✅ | ✅ | 💎 |
| `hideLoading` | Hides the loading spinner. | ✅ | ✅ | ✅ | 💎 |
| `clearForm` | Resets all fields to their default values. | ❌ | ✅ | ✅ | 💎 |
| `focusField` | Moves the cursor/attention to a specific field. | ❌ | ✅ | ✅ | 💎 |
| `disableField` | Makes a field uneditable (grayed out). | ❌ | ✅ | ✅ | 💎 |
| `enableField` | Makes a disabled field editable again. | ❌ | ✅ | ✅ | 💎 |
| `hideField` | Makes a field disappear from view. | ❌ | ✅ | ✅ | 💎 |
| `showField` | Makes a hidden field reappear. | ❌ | ✅ | ✅ | 💎 |
| `modalOpen` | Opens a popup modal dialog with custom content. | ❌ | ❌ | ✅ | 💎 |
| `modalClose` | Closes the currently open modal. | ❌ | ❌ | ✅ | 💎 |
| `toast` | Shows a temporary, non-modal notification. | ✅ | ✅ | ✅ | 💎 |
| `progressUpdate` | Updates a progress bar or indicator. | ❌ | ❌ | ✅ | 💎 |
| `scrollTo` | Scrolls the page to a specific element. | ❌ | ✅ | ✅ | 💎 |
| `animate` | Triggers CSS animations on elements. | ❌ | ❌ | ❌ | 💎 |
| `confirmationDialog` | Asks "Are you sure?" before proceeding. | ❌ | ❌ | ❌ | 💎 |
| `conditionalRender` | Shows/hides sections based on form data. | ❌ | ❌ | ❌ | 💎 |
| `wizardStep` | Moves forward or backward in a multi-step form. | ❌ | ❌ | ❌ | 💎 |
| `autoSave` | Automatically saves draft data every X seconds. | ❌ | ❌ | ❌ | 💎 |

---

## 12. Third-Party Integration Nodes
*Connects FormFlow to the rest of your SaaS stack.*

| Node | Functionality | Free | Pro | Business | Lifetime |
|------|---------------|------|-----|----------|----------|
| `mailchimp` | Adds a subscriber to a Mailchimp audience/list. | ❌ | ❌ | ✅ | 💎 |
| `sendgrid` | Sends email via SendGrid's API. | ❌ | ❌ | ✅ | 💎 |
| `hubspot` | Creates or updates a contact in HubSpot CRM. | ❌ | ❌ | ❌ | 💎 |
| `salesforce` | Creates a lead in Salesforce CRM. | ❌ | ❌ | ❌ | 💎 |
| `zapier` | Sends data to a Zapier webhook to trigger Zaps. | ❌ | ✅ | ✅ | 💎 |
| `make` | Sends data to Make.com (formerly Integromat) webhook. | ❌ | ✅ | ✅ | 💎 |
| `pabbly` | Sends data to Pabbly Connect. | ❌ | ❌ | ✅ | 💎 |
| `googleSheets` | Appends a row to a Google Sheet. | ❌ | ❌ | ✅ | 💎 |
| `airtable` | Creates a record in an Airtable base. | ❌ | ❌ | ✅ | 💎 |
| `notion` | Adds a page or item to a Notion database. | ❌ | ❌ | ❌ | 💎 |
| `typeform` | Submits answers to a Typeform (reverse integration). | ❌ | ❌ | ❌ | 💎 |
| `calendly` | Books a Calendly event on behalf of the user. | ❌ | ❌ | ❌ | 💎 |
| `stripe` | Creates a payment session or customer in Stripe. | ❌ | ❌ | ❌ | 💎 |
| `paypal` | Creates an order/subscription in PayPal. | ❌ | ❌ | ❌ | 💎 |
| `shopify` | Adds a customer or creates a cart in Shopify. | ❌ | ❌ | ❌ | 💎 |
| `wordpress` | Creates a post or user in WordPress (REST API). | ❌ | ❌ | ❌ | 💎 |

---

## 13. Debug & Logging Nodes
*See what's happening under the hood. Your eyes inside the machine.*

| Node | Functionality | Free | Pro | Business | Lifetime |
|------|---------------|------|-----|----------|----------|
| `consoleLog` | Outputs a message to the browser's developer console. | ✅ | ✅ | ✅ | 💎 |
| `serverLog` | Writes a message to the server's log file. | ❌ | ❌ | ✅ | 💎 |
| `debugBreak` | Pauses execution and allows step-through debugging. | ❌ | ❌ | ❌ | 💎 |
| `inspect` | Dumps the entire contents of a variable to console/log. | ✅ | ✅ | ✅ | 💎 |
| `emailLog` | Sends a log report to an email address. | ❌ | ❌ | ❌ | 💎 |
| `metric` | Records a custom metric (counter, gauge, histogram). | ❌ | ❌ | ❌ | 💎 |
| `timing` | Measures how long a block of nodes takes to execute. | ❌ | ❌ | ❌ | 💎 |
| `auditTrail` | Logs every change to a variable or record. | ❌ | ❌ | ❌ | 💎 |

---

## 14. Math & Calculation Nodes
*Crunch the numbers.*

| Node | Functionality | Free | Pro | Business | Lifetime |
|------|---------------|------|-----|----------|----------|
| `add` | Adds two numbers together. | ✅ | ✅ | ✅ | 💎 |
| `subtract` | Subtracts second number from first. | ✅ | ✅ | ✅ | 💎 |
| `multiply` | Multiplies two numbers. | ✅ | ✅ | ✅ | 💎 |
| `divide` | Divides first number by the second. | ✅ | ✅ | ✅ | 💎 |
| `modulo` | Returns the remainder of division. | ❌ | ✅ | ✅ | 💎 |
| `round` | Rounds to the nearest integer. | ❌ | ✅ | ✅ | 💎 |
| `ceil` | Rounds up to the nearest integer. | ❌ | ✅ | ✅ | 💎 |
| `floor` | Rounds down to the nearest integer. | ❌ | ✅ | ✅ | 💎 |
| `random` | Generates a random number within a range. | ❌ | ✅ | ✅ | 💎 |
| `sumArray` | Adds all numbers in an array together. | ❌ | ✅ | ✅ | 💎 |
| `average` | Calculates the mean of an array of numbers. | ❌ | ❌ | ✅ | 💎 |
| `counter` | Increments a persistent counter by X each call. | ❌ | ✅ | ✅ | 💎 |
| `percentage` | Calculates X% of Y. | ❌ | ❌ | ❌ | 💎 |
| `power` | Raises X to the power of Y (exponentiation). | ❌ | ❌ | ❌ | 💎 |
| `sqrt` | Returns the square root of a number. | ❌ | ❌ | ❌ | 💎 |
| `trigonometry` | Performs sine, cosine, tangent calculations. | ❌ | ❌ | ❌ | 💎 |

---

## 15. Date & Time Nodes
*Handle every timezone and calendar.*

| Node | Functionality | Free | Pro | Business | Lifetime |
|------|---------------|------|-----|----------|----------|
| `currentTime` | Returns the current timestamp or formatted date. | ✅ | ✅ | ✅ | 💎 |
| `formatDate` | Converts a date object to a custom string format. | ❌ | ❌ | ✅ | 💎 |
| `dateDiff` | Calculates the difference between two dates (days, hours, etc). | ❌ | ❌ | ❌ | 💎 |
| `dateAdd` | Adds X units (days, months) to a date. | ❌ | ❌ | ❌ | 💎 |
| `dateSubtract` | Subtracts X units from a date. | ❌ | ❌ | ❌ | 💎 |
| `timezoneConvert` | Converts a timestamp from one timezone to another. | ❌ | ❌ | ❌ | 💎 |
| `businessDays` | Calculates X business days from a start date (excludes weekends). | ❌ | ❌ | ❌ | 💎 |
| `recurringDates` | Generates next occurrence dates for recurring events. | ❌ | ❌ | ❌ | 💎 |

---

## 16. Conditional / Comparison Nodes
*Answer yes/no questions about your data.*

| Node | Functionality | Free | Pro | Business | Lifetime |
|------|---------------|------|-----|----------|----------|
| `equals` | Returns true if values are identical. | ✅ | ✅ | ✅ | 💎 |
| `notEquals` | Returns true if values are not identical. | ✅ | ✅ | ✅ | 💎 |
| `greaterThan` | Returns true if X > Y. | ✅ | ✅ | ✅ | 💎 |
| `lessThan` | Returns true if X < Y. | ✅ | ✅ | ✅ | 💎 |
| `contains` | Returns true if text includes a substring. | ❌ | ✅ | ✅ | 💎 |
| `startsWith` | Returns true if text begins with a substring. | ❌ | ✅ | ✅ | 💎 |
| `endsWith` | Returns true if text ends with a substring. | ❌ | ✅ | ✅ | 💎 |
| `isEmpty` | Returns true if string/array/object has no content. | ✅ | ✅ | ✅ | 💎 |
| `isNumeric` | Returns true if the value is a valid number. | ❌ | ✅ | ✅ | 💎 |
| `isEmail` | Returns true if the string is a valid email. | ✅ | ✅ | ✅ | 💎 |
| `isUrl` | Returns true if the string is a valid URL. | ❌ | ❌ | ✅ | 💎 |
| `exists` | Returns true if a variable/field is defined. | ✅ | ✅ | ✅ | 💎 |
| `between` | Returns true if a number is between X and Y (inclusive). | ❌ | ❌ | ❌ | 💎 |
| `inArray` | Returns true if a value exists in an array. | ❌ | ❌ | ❌ | 💎 |

---

## 17. Array/Collection Nodes
*Manage lists, stacks, and collections of data.*

| Node | Functionality | Free | Pro | Business | Lifetime |
|------|---------------|------|-----|----------|----------|
| `arrayCreate` | Creates a new array from provided values. | ❌ | ✅ | ✅ | 💎 |
| `arrayPush` | Adds one or more items to the end of an array. | ❌ | ✅ | ✅ | 💎 |
| `arrayPop` | Removes and returns the last item of an array. | ❌ | ✅ | ✅ | 💎 |
| `arrayShift` | Removes and returns the first item of an array. | ❌ | ✅ | ✅ | 💎 |
| `arrayUnshift` | Adds one or more items to the front of an array. | ❌ | ✅ | ✅ | 💎 |
| `arrayFilter` | Creates a new array with items that pass a test. | ❌ | ❌ | ✅ | 💎 |
| `arrayMap` | Transforms each item in an array to a new value. | ❌ | ❌ | ✅ | 💎 |
| `arrayFind` | Returns the first item matching a condition. | ❌ | ❌ | ✅ | 💎 |
| `arrayUnique` | Removes duplicate values from an array. | ❌ | ❌ | ❌ | 💎 |
| `arraySort` | Sorts array items alphabetically or numerically. | ❌ | ❌ | ❌ | 💎 |
| `arrayLength` | Returns the number of items in an array. | ❌ | ✅ | ✅ | 💎 |
| `arrayJoin` | Combines array items into a string with a separator. | ❌ | ✅ | ✅ | 💎 |
| `arrayGroupBy` | Groups array items by a key/property (like SQL GROUP BY). | ❌ | ❌ | ❌ | 💎 |
| `arrayChunk` | Splits an array into smaller arrays of a fixed size. | ❌ | ❌ | ❌ | 💎 |

---

## 18. HTTP / API Nodes
*Talk to external REST and GraphQL APIs.*

| Node | Functionality | Free | Pro | Business | Lifetime |
|------|---------------|------|-----|----------|----------|
| `httpGet` | Performs an HTTP GET request. | ❌ | ✅ | ✅ | 💎 |
| `httpPost` | Performs an HTTP POST request with a body. | ❌ | ✅ | ✅ | 💎 |
| `httpPut` | Performs an HTTP PUT request (full update). | ❌ | ❌ | ✅ | 💎 |
| `httpPatch` | Performs an HTTP PATCH request (partial update). | ❌ | ❌ | ✅ | 💎 |
| `httpDelete` | Performs an HTTP DELETE request. | ❌ | ❌ | ✅ | 💎 |
| `httpHead` | Performs an HTTP HEAD request (returns headers only). | ❌ | ❌ | ❌ | 💎 |
| `graphql` | Executes a GraphQL query or mutation. | ❌ | ❌ | ❌ | 💎 |
| `apiAuth` | Handles OAuth2 or API key authentication flows. | ❌ | ❌ | ❌ | 💎 |
| `httpRetry` | Automatically retries failed HTTP requests with backoff. | ❌ | ❌ | ❌ | 💎 |

---

## 19. File Processing Nodes
*Manipulate images, PDFs, CSVs, and more.*

| Node | Functionality | Free | Pro | Business | Lifetime |
|------|---------------|------|-----|----------|----------|
| `imageResize` | Changes an image's dimensions (width/height). | ❌ | ❌ | ❌ | 💎 |
| `imageCompress` | Reduces an image's file size (quality loss optional). | ❌ | ❌ | ❌ | 💎 |
| `imageConvert` | Converts between formats (PNG, JPG, WEBP). | ❌ | ❌ | ❌ | 💎 |
| `pdfGenerate` | Creates a PDF from HTML or a template. | ❌ | ❌ | ❌ | 💎 |
| `csvGenerate` | Converts array data into a downloadable CSV string. | ❌ | ✅ | ✅ | 💎 |
| `csvParse` | Parses CSV content into an array of objects. | ❌ | ✅ | ✅ | 💎 |
| `excelGenerate` | Creates an Excel (.xlsx) file from data. | ❌ | ❌ | ❌ | 💎 |
| `excelParse` | Parses an uploaded Excel file into JSON. | ❌ | ❌ | ❌ | 💎 |
| `qrGenerate` | Generates a QR code image from text/URL. | ❌ | ❌ | ✅ | 💎 |
| `barcodeGenerate` | Generates a barcode (UPC, EAN, Code128) image. | ❌ | ❌ | ❌ | 💎 |
| `watermarkImage` | Adds a text or image watermark to a photo. | ❌ | ❌ | ❌ | 💎 |

---

## 20. End / Output Nodes
*The finish line. How your flow ends.*

| Node | Functionality | Free | Pro | Business | Lifetime |
|------|---------------|------|-----|----------|----------|
| `returnSuccess` | Ends the flow and returns a success status (200). | ✅ | ✅ | ✅ | 💎 |
| `returnError` | Ends the flow and returns an error status (4xx/5xx). | ✅ | ✅ | ✅ | 💎 |
| `returnData` | Ends the flow and returns specific data to the caller. | ❌ | ✅ | ✅ | 💎 |
| `stop` | Immediately stops execution without returning anything. | ✅ | ✅ | ✅ | 💎 |
| `abort` | Stops execution and rolls back any database changes. | ❌ | ✅ | ✅ | 💎 |

---

## 📊 Summary Dashboard (The Biased Truth)

| Tier | Nodes | % of Total | Monthly Cost | Value |
|------|-------|------------|--------------|-------|
| 🟢 **Free** | **15** | 6% | $0 | 😭 Pathetic |
| 🔵 **Pro** | **60** | 23% | $29 | 🙂 Acceptable |
| 🟠 **Business** | **120** | 46% | $99 | 😊 Almost there |
| 💎 **Lifetime** | **262** | **100%** | **$0 after payment** | 🤯 **GOD MODE** |

---

## 🎯 The Obvious Recommendation

### 💎 Lifetime Tier gets you:
- **ALL 262 nodes** (not just 15 or 60 or 120)
- **All future nodes** (free upgrades forever)
- **No monthly subscription** (pay once, done)
- **Instant VIP support** (skip the queue)
- **White-label option** (your branding)
- **Self-hostable version** (your servers)
- **Unlimited forms** (no artificial limits)
- **Unlimited submissions** (no throttling)
- **Team accounts** (5 users included)
- **Priority feature requests** (we build what you want)

### Compare:

| Feature | Free | Pro | Business | Lifetime |
|---------|------|-----|----------|----------|
| Basic form fields | ✅ | ✅ | ✅ | ✅ |
| Email sending | ❌ | ✅ | ✅ | ✅ |
| Database storage | ❌ | ❌ | ✅ | ✅ |
| All 262 nodes | ❌ | ❌ | ❌ | ✅ |
| Future updates | ❌ | ❌ | ❌ | ✅ |
| No subscription | ✅ | ❌ | ❌ | ✅ |
| Self-host | ❌ | ❌ | ❌ | ✅ |
| White-label | ❌ | ❌ | ❌ | ✅ |

---

## 🚀 Final Biased Conclusion

> **"Free is a teaser. Pro is for testing. Business is for commitment. Lifetime is for smart people who hate subscriptions."**

**Buy Lifetime once. Cry once. Build forever.**

---