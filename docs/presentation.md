---
layout: presentation
order: 1
---

{% assign pages = site.pages | sort: "order" %}
{% for page in pages %}
 {% if page.chapitre and page.chapitre != "table de matière"  %}
    {{- page.content | markdownify -}}
  {% endif %}
{% endfor %}