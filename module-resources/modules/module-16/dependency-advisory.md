# Dependency advisory: the notes date picker

**From:** TechCorp application security
**To:** the portal team
**Distribution:** internal

---

## Summary

An advisory has been published against the date-picker library the portal loads
from a public CDN. It affects the versions we load. There is no patched
version pinned in our application, because we do not pin a version at all.

> The advisory reports that a value passed to the library's date field can
> reach a DOM sink inside the library and be interpreted as markup rather than
> as a date. Exploitation requires that an attacker be able to influence the
> value the library reads.

That last sentence is the whole reason this is an advisory and not an
instruction. **Whether it applies to us depends on our call sites, not on the
advisory.** Nobody outside this application can answer that.

## Why you are receiving this now and not in week one

This dependency is not new, and neither is our exposure to it.

The review scan the instructor ran against the portal in Module 07
raised two passive alerts against the page shell:


| **Entry** | **Alert** | **Severity** | **Disposition** |
|---|---|---|---|
| BL-017 | Cross-Domain JavaScript Source File Inclusion | Low | Accepted: third-party script from a well-known CDN |
| BL-018 | Sub-Resource Integrity Attribute Missing | Low | Accepted: no integrity attribute on the CDN tags |

Both were triaged as low-severity informational findings and deprioritized in
favor of the injection, access-control, and authentication work. **That was the
right call at the time**, and this advisory does not make it the wrong one.
Every one of the findings ranked above these two was more urgent, and a team
that had stopped to vendor a date picker in week one would have shipped an
application that was still leaking customer records.

The finding was
accepted, not closed, and an accepted finding is a finding that is still there
when circumstances move.

**Risk accepted is not risk eliminated.** It is risk you agreed to carry, and
carrying it has a cost that arrives on a schedule you do not control.

## What we are asking for

Two things, in this order.

1. **A reachability determination.** Does untrusted input actually reach the
   affected code path in this application? Answer it from the call sites, with
   the file and the line. A scanner can tell you the library is loaded. It
   cannot tell you whether you are affected.

2. **A remediation decision, with the reasoning written down.** The options are
   below. They are not equivalent, they do not address the same risk, and more
   than one of them can be correct at the same time. We want the choice and we
   want the argument for it, including what you considered and rejected.

## Options


| **Option** | **What it does** | **What it does not do** |
|---|---|---|
| **Vendor and pin**: copy a fixed version of the library into the repository, serve it from our own origin, and add `Content-Security-Policy: script-src 'self'` | Removes the CDN from our trust boundary. We control which bytes execute, and the header stops any script from an origin we did not choose | Nothing about the version you vendor. If you vendor the same version, you have kept the flaw and changed only who serves it |
| **Add Subresource Integrity**: put an `integrity` hash and `crossorigin="anonymous"` on the CDN tags | Guarantees the browser executes exactly the bytes whose hash you recorded, and refuses anything else. This is the control against a compromised or swapped CDN artifact | Anything about a flaw *in* those bytes. SRI proves you got what you asked for; it does not say what you asked for is safe |
| **Drop the dependency**: replace the picker with the browser's native date input | Removes the library, the CDN, the advisory, and every future advisory against it, in one commit | Come for free. The control looks and behaves differently, and the value your code receives is formatted by the browser rather than by your options object |
| **Sanitize before the call**: validate the value server-side against a strict date format before it is ever written into the field the library reads | Removes reachability. If nothing that could reach the vulnerable path can get into the field, the path is not reachable from the outside | Remove the library or the flaw. It is a compensating control, and it holds only for as long as this remains the only call site |

## Notes for whoever implements this

- **Subresource Integrity on a cross-origin script needs `crossorigin="anonymous"`.**
  Without it the browser cannot read the response for integrity checking and
  blocks the script outright. The symptom is that the picker silently stops
  working and the console reports an integrity failure, which reads exactly like
  a wrong hash. It is not a wrong hash. Add the attribute to both the script and
  the stylesheet tag.
- The stylesheet is loaded from the same CDN as the script. A decision that
  covers only the `<script>` tag has covered half of what the baseline scan
  flagged.
- If you choose a Content-Security-Policy header, check what else on the page it
  breaks before you ship it. Inline `<script>` blocks are the usual casualty.

## What this advisory is not

**There is no branch to merge.** Nothing has been prepared for you, and nothing
is waiting in a pull request. This is a notification that a condition changed;
the determination is yours, the decision is yours, and the commit is yours.

That is not an oversight in how this was sent. It is what an advisory is. The
work of deciding whether an advisory applies to your application, and what to do
about it, does not have an upstream owner. It has this team.
