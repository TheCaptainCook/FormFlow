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

| Node | Free | Pro | Business | Lifetime | Time |
|------|------|-----|----------|----------|------|
| `onPageLoad` | ✅ | ✅ | ✅ | 💎 | 2h |
| `onButtonClick` | ✅ | ✅ | ✅ | 💎 | 2h |
| `onFormSubmit` | ✅ | ✅ | ✅ | 💎 | 3h |
| `onFieldChange` | ❌ | ✅ | ✅ | 💎 | 4h |
| `onTimer` | ❌ | ❌ | ✅ | 💎 | 6h |
| `onScroll` | ❌ | ❌ | ❌ | 💎 | 8h |
| `onWebhookReceive` | ❌ | ❌ | ❌ | 💎 | 16h |
| `onSchedule` | ❌ | ❌ | ❌ | 💎 | 20h |

---

## 2. Input / Field Nodes

*What you use to collect data from the user. Each field node has 4 connection points: **top** and **bottom** are used to define where the form fields are placed (priority flow), and **left** and **right** are used to apply properties from other nodes (conditional data flow).*

**Port Architecture:** `priority-in` (top) · `priority-out` (bottom) · `cond-in` (left) · `cond-out` (right)

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

| Node | Free | Pro | Business | Lifetime | Time |
|------|------|-----|----------|----------|------|
| `validateRequired` | ✅ | ✅ | ✅ | 💎 | 2h |
| `validateEmail` | ✅ | ✅ | ✅ | 💎 | 2h |
| `validateRegex` | ❌ | ✅ | ✅ | 💎 | 3h |
| `validateMinLength` | ✅ | ✅ | ✅ | 💎 | 1h |
| `validateMaxLength` | ✅ | ✅ | ✅ | 💎 | 1h |
| `validateMinValue` | ❌ | ✅ | ✅ | 💎 | 1h |
| `validateMaxValue` | ❌ | ✅ | ✅ | 💎 | 1h |
| `validateMatch` | ❌ | ✅ | ✅ | 💎 | 3h |
| `validateUnique` | ❌ | ❌ | ✅ | 💎 | 16h |
| `validateFileType` | ❌ | ❌ | ✅ | 💎 | 4h |
| `validateFileSize` | ❌ | ❌ | ✅ | 💎 | 3h |
| `validateDateRange` | ❌ | ❌ | ❌ | 💎 | 6h |
| `validateAge` | ❌ | ❌ | ❌ | 💎 | 4h |
| `validateCreditCard` | ❌ | ❌ | ❌ | 💎 | 8h |
| `validatePostalCode` | ❌ | ❌ | ❌ | 💎 | 6h |
| `validateVAT` | ❌ | ❌ | ❌ | 💎 | 12h |
| `validateIBAN` | ❌ | ❌ | ❌ | 💎 | 10h |

---

## 4. Spam Protection Nodes

| Node | Free | Pro | Business | Lifetime | Time |
|------|------|-----|----------|----------|------|
| `honeypot` | ✅ | ✅ | ✅ | 💎 | 4h |
| `rateLimiter` | ❌ | ✅ | ✅ | 💎 | 12h |
| `recaptcha` | ❌ | ❌ | ✅ | 💎 | 8h |
| `turnstile` | ❌ | ❌ | ✅ | 💎 | 8h |
| `hcaptcha` | ❌ | ❌ | ❌ | 💎 | 8h |
| `blocklistEmail` | ❌ | ❌ | ❌ | 💎 | 10h |
| `blocklistIP` | ❌ | ❌ | ❌ | 💎 | 12h |
| `blocklistKeyword` | ❌ | ❌ | ❌ | 💎 | 8h |
| `timeTrap` | ✅ | ✅ | ✅ | 💎 | 3h |
| `fingerprint` | ❌ | ❌ | ❌ | 💎 | 24h |

---

## 5. Logic & Flow Control Nodes

| Node | Free | Pro | Business | Lifetime | Time |
|------|------|-----|----------|----------|------|
| `condition` | ✅ | ✅ | ✅ | 💎 | 16h |
| `switch` | ❌ | ✅ | ✅ | 💎 | 12h |
| `merge` | ❌ | ✅ | ✅ | 💎 | 6h |
| `delay` | ❌ | ✅ | ✅ | 💎 | 4h |
| `loop` | ❌ | ❌ | ✅ | 💎 | 20h |
| `break` | ❌ | ❌ | ✅ | 💎 | 4h |
| `continue` | ❌ | ❌ | ✅ | 💎 | 4h |
| `terminate` | ✅ | ✅ | ✅ | 💎 | 3h |
| `fork` | ❌ | ❌ | ❌ | 💎 | 24h |
| `join` | ❌ | ❌ | ❌ | 💎 | 16h |
| `retry` | ❌ | ❌ | ❌ | 💎 | 12h |
| `circuitBreaker` | ❌ | ❌ | ❌ | 💎 | 20h |

---

## 6. Data Transformation Nodes

| Node | Free | Pro | Business | Lifetime | Time |
|------|------|-----|----------|----------|------|
| `trim` | ✅ | ✅ | ✅ | 💎 | 1h |
| `lowercase` | ✅ | ✅ | ✅ | 💎 | 1h |
| `uppercase` | ✅ | ✅ | ✅ | 💎 | 1h |
| `capitalize` | ❌ | ✅ | ✅ | 💎 | 2h |
| `sanitizeHtml` | ❌ | ✅ | ✅ | 💎 | 6h |
| `escape` | ❌ | ✅ | ✅ | 💎 | 2h |
| `slugify` | ❌ | ❌ | ✅ | 💎 | 3h |
| `truncate` | ✅ | ✅ | ✅ | 💎 | 1h |
| `formatPhone` | ❌ | ❌ | ✅ | 💎 | 8h |
| `formatDate` | ❌ | ❌ | ✅ | 💎 | 6h |
| `concat` | ✅ | ✅ | ✅ | 💎 | 1h |
| `split` | ❌ | ✅ | ✅ | 💎 | 1h |
| `replace` | ❌ | ✅ | ✅ | 💎 | 2h |
| `extract` | ❌ | ❌ | ❌ | 💎 | 6h |
| `jsonParse` | ✅ | ✅ | ✅ | 💎 | 2h |
| `jsonStringify` | ✅ | ✅ | ✅ | 💎 | 2h |
| `base64Encode` | ❌ | ✅ | ✅ | 💎 | 1h |
| `base64Decode` | ❌ | ✅ | ✅ | 💎 | 1h |
| `hash` | ❌ | ❌ | ✅ | 💎 | 4h |
| `encrypt` | ❌ | ❌ | ❌ | 💎 | 16h |
| `decrypt` | ❌ | ❌ | ❌ | 💎 | 12h |
| `maskPII` | ❌ | ❌ | ❌ | 💎 | 10h |

---

## 7. Variable Nodes

| Node | Free | Pro | Business | Lifetime | Time |
|------|------|-----|----------|----------|------|
| `setVariable` | ✅ | ✅ | ✅ | 💎 | 4h |
| `getVariable` | ✅ | ✅ | ✅ | 💎 | 2h |
| `increment` | ❌ | ✅ | ✅ | 💎 | 2h |
| `decrement` | ❌ | ✅ | ✅ | 💎 | 2h |
| `variableExists` | ❌ | ✅ | ✅ | 💎 | 2h |
| `clearVariable` | ❌ | ✅ | ✅ | 💎 | 1h |
| `sessionGet` | ✅ | ✅ | ✅ | 💎 | 3h |
| `sessionSet` | ✅ | ✅ | ✅ | 💎 | 3h |
| `localGet` | ✅ | ✅ | ✅ | 💎 | 3h |
| `localSet` | ✅ | ✅ | ✅ | 💎 | 3h |
| `cookieGet` | ❌ | ❌ | ✅ | 💎 | 6h |
| `cookieSet` | ❌ | ❌ | ✅ | 💎 | 6h |
| `globalVariable` | ❌ | ❌ | ❌ | 💎 | 10h |
| `redisVariable` | ❌ | ❌ | ❌ | 💎 | 16h |

---

## 8. Action / Destination Nodes

| Node | Free | Pro | Business | Lifetime | Time |
|------|------|-----|----------|----------|------|
| `sendEmail` | ❌ | ✅ | ✅ | 💎 | 24h |
| `sendEmailBatch` | ❌ | ❌ | ✅ | 💎 | 12h |
| `saveDatabase` | ❌ | ❌ | ✅ | 💎 | 40h |
| `updateDatabase` | ❌ | ❌ | ✅ | 💎 | 20h |
| `webhook` | ✅ | ✅ | ✅ | 💎 | 8h |
| `webhookGet` | ✅ | ✅ | ✅ | 💎 | 6h |
| `redirect` | ✅ | ✅ | ✅ | 💎 | 2h |
| `downloadFile` | ❌ | ❌ | ✅ | 💎 | 6h |
| `print` | ❌ | ✅ | ✅ | 💎 | 2h |
| `copyToClipboard` | ❌ | ✅ | ✅ | 💎 | 4h |
| `webhookSigned` | ❌ | ❌ | ❌ | 💎 | 10h |
| `queueMessage` | ❌ | ❌ | ❌ | 💎 | 16h |
| `webSocket` | ❌ | ❌ | ❌ | 💎 | 24h |

---

## 9. Notification Nodes

| Node | Free | Pro | Business | Lifetime | Time |
|------|------|-----|----------|----------|------|
| `slack` | ❌ | ✅ | ✅ | 💎 | 8h |
| `discord` | ❌ | ✅ | ✅ | 💎 | 6h |
| `telegram` | ❌ | ❌ | ✅ | 💎 | 8h |
| `teams` | ❌ | ❌ | ❌ | 💎 | 10h |
| `sms` | ❌ | ❌ | ❌ | 💎 | 24h |
| `pushbullet` | ❌ | ❌ | ❌ | 💎 | 6h |
| `webPush` | ❌ | ❌ | ❌ | 💎 | 16h |
| `emailAutoResponder` | ❌ | ✅ | ✅ | 💎 | 16h |
| `whatsapp` | ❌ | ❌ | ❌ | 💎 | 32h |
| `pushover` | ❌ | ❌ | ❌ | 💎 | 6h |

---

## 10. Storage Nodes (File/Cloud)

| Node | Free | Pro | Business | Lifetime | Time |
|------|------|-----|----------|----------|------|
| `saveFileLocal` | ❌ | ✅ | ✅ | 💎 | 8h |
| `uploadS3` | ❌ | ❌ | ✅ | 💎 | 24h |
| `uploadGCS` | ❌ | ❌ | ✅ | 💎 | 24h |
| `uploadAzure` | ❌ | ❌ | ✅ | 💎 | 24h |
| `uploadDropbox` | ❌ | ❌ | ❌ | 💎 | 16h |
| `uploadFTP` | ❌ | ❌ | ❌ | 💎 | 12h |
| `deleteFile` | ❌ | ❌ | ✅ | 💎 | 4h |
| `streamingUpload` | ❌ | ❌ | ❌ | 💎 | 20h |

---

## 11. UI/UX Nodes

| Node | Free | Pro | Business | Lifetime | Time |
|------|------|-----|----------|----------|------|
| `showSuccess` | ✅ | ✅ | ✅ | 💎 | 2h |
| `showError` | ✅ | ✅ | ✅ | 💎 | 2h |
| `showWarning` | ❌ | ✅ | ✅ | 💎 | 2h |
| `showLoading` | ✅ | ✅ | ✅ | 💎 | 3h |
| `hideLoading` | ✅ | ✅ | ✅ | 💎 | 1h |
| `clearForm` | ❌ | ✅ | ✅ | 💎 | 4h |
| `focusField` | ❌ | ✅ | ✅ | 💎 | 2h |
| `disableField` | ❌ | ✅ | ✅ | 💎 | 2h |
| `enableField` | ❌ | ✅ | ✅ | 💎 | 2h |
| `hideField` | ❌ | ✅ | ✅ | 💎 | 2h |
| `showField` | ❌ | ✅ | ✅ | 💎 | 2h |
| `modalOpen` | ❌ | ❌ | ✅ | 💎 | 8h |
| `modalClose` | ❌ | ❌ | ✅ | 💎 | 2h |
| `toast` | ✅ | ✅ | ✅ | 💎 | 6h |
| `progressUpdate` | ❌ | ❌ | ✅ | 💎 | 6h |
| `scrollTo` | ❌ | ✅ | ✅ | 💎 | 3h |
| `animate` | ❌ | ❌ | ❌ | 💎 | 8h |
| `confirmationDialog` | ❌ | ❌ | ❌ | 💎 | 10h |
| `conditionalRender` | ❌ | ❌ | ❌ | 💎 | 12h |
| `wizardStep` | ❌ | ❌ | ❌ | 💎 | 20h |
| `autoSave` | ❌ | ❌ | ❌ | 💎 | 16h |

---

## 12. Third-Party Integration Nodes

| Node | Free | Pro | Business | Lifetime | Time |
|------|------|-----|----------|----------|------|
| `mailchimp` | ❌ | ❌ | ✅ | 💎 | 16h |
| `sendgrid` | ❌ | ❌ | ✅ | 💎 | 12h |
| `hubspot` | ❌ | ❌ | ❌ | 💎 | 24h |
| `salesforce` | ❌ | ❌ | ❌ | 💎 | 40h |
| `zapier` | ❌ | ✅ | ✅ | 💎 | 8h |
| `make` | ❌ | ✅ | ✅ | 💎 | 8h |
| `pabbly` | ❌ | ❌ | ✅ | 💎 | 8h |
| `googleSheets` | ❌ | ❌ | ✅ | 💎 | 20h |
| `airtable` | ❌ | ❌ | ✅ | 💎 | 12h |
| `notion` | ❌ | ❌ | ❌ | 💎 | 16h |
| `typeform` | ❌ | ❌ | ❌ | 💎 | 10h |
| `calendly` | ❌ | ❌ | ❌ | 💎 | 24h |
| `stripe` | ❌ | ❌ | ❌ | 💎 | 32h |
| `paypal` | ❌ | ❌ | ❌ | 💎 | 32h |
| `shopify` | ❌ | ❌ | ❌ | 💎 | 28h |
| `wordpress` | ❌ | ❌ | ❌ | 💎 | 20h |

---

## 13. Debug & Logging Nodes

| Node | Free | Pro | Business | Lifetime | Time |
|------|------|-----|----------|----------|------|
| `consoleLog` | ✅ | ✅ | ✅ | 💎 | 1h |
| `serverLog` | ❌ | ❌ | ✅ | 💎 | 6h |
| `debugBreak` | ❌ | ❌ | ❌ | 💎 | 4h |
| `inspect` | ✅ | ✅ | ✅ | 💎 | 4h |
| `emailLog` | ❌ | ❌ | ❌ | 💎 | 8h |
| `metric` | ❌ | ❌ | ❌ | 💎 | 12h |
| `timing` | ❌ | ❌ | ❌ | 💎 | 6h |
| `auditTrail` | ❌ | ❌ | ❌ | 💎 | 20h |

---

## 14. Math & Calculation Nodes

| Node | Free | Pro | Business | Lifetime | Time |
|------|------|-----|----------|----------|------|
| `add` | ✅ | ✅ | ✅ | 💎 | 1h |
| `subtract` | ✅ | ✅ | ✅ | 💎 | 1h |
| `multiply` | ✅ | ✅ | ✅ | 💎 | 1h |
| `divide` | ✅ | ✅ | ✅ | 💎 | 1h |
| `modulo` | ❌ | ✅ | ✅ | 💎 | 1h |
| `round` | ❌ | ✅ | ✅ | 💎 | 1h |
| `ceil` | ❌ | ✅ | ✅ | 💎 | 1h |
| `floor` | ❌ | ✅ | ✅ | 💎 | 1h |
| `random` | ❌ | ✅ | ✅ | 💎 | 1h |
| `sumArray` | ❌ | ✅ | ✅ | 💎 | 2h |
| `average` | ❌ | ❌ | ✅ | 💎 | 2h |
| `counter` | ❌ | ✅ | ✅ | 💎 | 4h |
| `percentage` | ❌ | ❌ | ❌ | 💎 | 2h |
| `power` | ❌ | ❌ | ❌ | 💎 | 1h |
| `sqrt` | ❌ | ❌ | ❌ | 💎 | 1h |
| `trigonometry` | ❌ | ❌ | ❌ | 💎 | 8h |

---

## 15. Date & Time Nodes

| Node | Free | Pro | Business | Lifetime | Time |
|------|------|-----|----------|----------|------|
| `currentTime` | ✅ | ✅ | ✅ | 💎 | 1h |
| `formatDate` | ❌ | ❌ | ✅ | 💎 | 6h |
| `dateDiff` | ❌ | ❌ | ❌ | 💎 | 6h |
| `dateAdd` | ❌ | ❌ | ❌ | 💎 | 4h |
| `dateSubtract` | ❌ | ❌ | ❌ | 💎 | 4h |
| `timezoneConvert` | ❌ | ❌ | ❌ | 💎 | 12h |
| `businessDays` | ❌ | ❌ | ❌ | 💎 | 10h |
| `recurringDates` | ❌ | ❌ | ❌ | 💎 | 16h |

---

## 16. Conditional / Comparison Nodes

| Node | Free | Pro | Business | Lifetime | Time |
|------|------|-----|----------|----------|------|
| `equals` | ✅ | ✅ | ✅ | 💎 | 1h |
| `notEquals` | ✅ | ✅ | ✅ | 💎 | 1h |
| `greaterThan` | ✅ | ✅ | ✅ | 💎 | 1h |
| `lessThan` | ✅ | ✅ | ✅ | 💎 | 1h |
| `contains` | ❌ | ✅ | ✅ | 💎 | 1h |
| `startsWith` | ❌ | ✅ | ✅ | 💎 | 1h |
| `endsWith` | ❌ | ✅ | ✅ | 💎 | 1h |
| `isEmpty` | ✅ | ✅ | ✅ | 💎 | 1h |
| `isNumeric` | ❌ | ✅ | ✅ | 💎 | 2h |
| `isEmail` | ✅ | ✅ | ✅ | 💎 | 2h |
| `isUrl` | ❌ | ❌ | ✅ | 💎 | 3h |
| `exists` | ✅ | ✅ | ✅ | 💎 | 1h |
| `between` | ❌ | ❌ | ❌ | 💎 | 2h |
| `inArray` | ❌ | ❌ | ❌ | 💎 | 3h |

---

## 17. Array/Collection Nodes

| Node | Free | Pro | Business | Lifetime | Time |
|------|------|-----|----------|----------|------|
| `arrayCreate` | ❌ | ✅ | ✅ | 💎 | 1h |
| `arrayPush` | ❌ | ✅ | ✅ | 💎 | 1h |
| `arrayPop` | ❌ | ✅ | ✅ | 💎 | 1h |
| `arrayShift` | ❌ | ✅ | ✅ | 💎 | 1h |
| `arrayUnshift` | ❌ | ✅ | ✅ | 💎 | 1h |
| `arrayFilter` | ❌ | ❌ | ✅ | 💎 | 6h |
| `arrayMap` | ❌ | ❌ | ✅ | 💎 | 6h |
| `arrayFind` | ❌ | ❌ | ✅ | 💎 | 4h |
| `arrayUnique` | ❌ | ❌ | ❌ | 💎 | 4h |
| `arraySort` | ❌ | ❌ | ❌ | 💎 | 6h |
| `arrayLength` | ❌ | ✅ | ✅ | 💎 | 1h |
| `arrayJoin` | ❌ | ✅ | ✅ | 💎 | 2h |
| `arrayGroupBy` | ❌ | ❌ | ❌ | 💎 | 10h |
| `arrayChunk` | ❌ | ❌ | ❌ | 💎 | 6h |

---

## 18. HTTP / API Nodes

| Node | Free | Pro | Business | Lifetime | Time |
|------|------|-----|----------|----------|------|
| `httpGet` | ❌ | ✅ | ✅ | 💎 | 8h |
| `httpPost` | ❌ | ✅ | ✅ | 💎 | 8h |
| `httpPut` | ❌ | ❌ | ✅ | 💎 | 6h |
| `httpPatch` | ❌ | ❌ | ✅ | 💎 | 6h |
| `httpDelete` | ❌ | ❌ | ✅ | 💎 | 4h |
| `httpHead` | ❌ | ❌ | ❌ | 💎 | 4h |
| `graphql` | ❌ | ❌ | ❌ | 💎 | 24h |
| `apiAuth` | ❌ | ❌ | ❌ | 💎 | 16h |
| `httpRetry` | ❌ | ❌ | ❌ | 💎 | 8h |

---

## 19. File Processing Nodes

| Node | Free | Pro | Business | Lifetime | Time |
|------|------|-----|----------|----------|------|
| `imageResize` | ❌ | ❌ | ❌ | 💎 | 24h |
| `imageCompress` | ❌ | ❌ | ❌ | 💎 | 20h |
| `imageConvert` | ❌ | ❌ | ❌ | 💎 | 16h |
| `pdfGenerate` | ❌ | ❌ | ❌ | 💎 | 32h |
| `csvGenerate` | ❌ | ✅ | ✅ | 💎 | 8h |
| `csvParse` | ❌ | ✅ | ✅ | 💎 | 6h |
| `excelGenerate` | ❌ | ❌ | ❌ | 💎 | 24h |
| `excelParse` | ❌ | ❌ | ❌ | 💎 | 20h |
| `qrGenerate` | ❌ | ❌ | ✅ | 💎 | 6h |
| `barcodeGenerate` | ❌ | ❌ | ❌ | 💎 | 10h |
| `watermarkImage` | ❌ | ❌ | ❌ | 💎 | 12h |

---

## 20. End / Output Nodes

| Node | Free | Pro | Business | Lifetime | Time |
|------|------|-----|----------|----------|------|
| `returnSuccess` | ✅ | ✅ | ✅ | 💎 | 1h |
| `returnError` | ✅ | ✅ | ✅ | 💎 | 1h |
| `returnData` | ❌ | ✅ | ✅ | 💎 | 2h |
| `stop` | ✅ | ✅ | ✅ | 💎 | 1h |
| `abort` | ❌ | ✅ | ✅ | 💎 | 2h |

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