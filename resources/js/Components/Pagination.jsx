import { Link } from "@inertiajs/react";

export default function Pagination({ links }) {
  if (!links.length) return null; // no pagination if only one page

  return (
    <nav className="text-center mt-4 space-x-1">
      {links.map((link, id) => {
        const isDisabled = !link.url;
        const isActive = link.active;

        const classes = `
          inline-block py-2 px-3 rounded-lg text-xs
          ${isActive ? "bg-gray-950 text-white" : "text-gray-200"}
          ${isDisabled ? "!text-gray-500 cursor-not-allowed" : "hover:bg-gray-950"}
        `;

        return (
          <Link
            key={id}
            href={link.url || ""}
            preserveScroll
            className={classes}
            dangerouslySetInnerHTML={{ __html: link.label }}
          />
        );
      })}
    </nav>
  );
}
