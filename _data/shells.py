import os
import yaml
import xml.etree.ElementTree as ET
from collections import defaultdict
from xml.dom import minidom

# Path berdasarkan lokasi script
dir = os.path.dirname(os.path.abspath(__file__))

yml_file = os.path.join(dir, "shells.yml")
xml_file = os.path.join(dir, "..", "index.xml")

with open(yml_file, "r", encoding="utf-8") as f:
    data = yaml.safe_load(f)

# Group by category
categories = defaultdict(list)
for entry in data:
    categories[entry["category"]].append(entry)

root = ET.Element("webshells")

for cat_name, items in categories.items():
    category = ET.SubElement(root, "category")
    category.set("name", cat_name)

    for entry in items:
        item = ET.SubElement(category, "item")
        for key, value in entry.items():
            if key == "category":
                continue
            el = ET.SubElement(item, key)
            el.text = str(value) if value is not None else ""

# Convert ke string dan pretty print
xml_str = ET.tostring(root, encoding="utf-8")
parsed = minidom.parseString(xml_str)
pretty_xml = parsed.toprettyxml(indent="  ")

# Save File di ../index.xml
with open(xml_file, "w", encoding="utf-8") as f:
    f.write(pretty_xml)

print(f"XML berhasil disimpan di: {xml_file}")
